<?php

namespace Testing;

use \WP_REST_Request;
use KeriganSolutions\KMAMail\Message;
use KeriganSolutions\KMAMail\KMAMail;

class PermitForm
{

    public $name;
    public $email;
    public $maxWidth;
    public $maxDepth;
    public $bedrooms;
    public $bathrooms;
    public $elevator;
    public $floodZone;
    public $comments;
    public $request;
    public $error;

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'registerRoutes']);
    }
    /**
     * Add REST API routes
     */
    public function registerRoutes()
    {
        register_rest_route(
            'kerigansolutions/v1',
            '/submit-permit-form',
            [
                'methods' => 'POST',
                'callback' => [$this, 'submitPermitForm']
            ]
        );
    }

    public function checkForErrors()
    {
        $name  = $this->request->get_param('name') != '' ? $this->request->get_param('name') : null;
        $email = $this->request->get_param('email') !== '' ? $this->request->get_param('email') : null;

        $this->error = $this->validate($name, $email);
    }

    public function createPost()
    {
        $defaults = array(
            'post_title' => $this->name,
            'post_type' => 'planning_request',
            'menu_order' => 0,
            'post_status' => 'publish'
        );

        return wp_insert_post($defaults);
    }

    public function persistToDashboard()
    {
        $id = $this->createPost();

        foreach ($this->request->get_params() as $param => $value) {
            $this->$param = $value;
            if ($param !== 'name') {
                update_post_meta($id, $param, $value);
            }
        }

    }

    public function submitPermitForm(WP_REST_Request $request)
    {
        $this->request = $request;
        $this->checkForErrors();
        if ($this->error) {
            return $this->error;
        }
        $this->persistToDashboard();
        $this->sendEmail();
        $this->sendBounceback();

        return rest_ensure_response(json_encode(['message' => 'Success']));
    }

    public function sendEmail()
    {
        $headers  = 'MIME-Version: 1.0' . PHP_EOL;
        $headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;

        $message = new Message();
        $message->setHeadline('New Plans & Permitting Request')
                ->setBody($this->messageBody('You\'ve received a new Plans & Permitting request.'))
                ->setHeaders($headers)
                ->setSubject('New Plans & Permitting Request')
                ->setPrimaryColor('#b73838')
                ->setSecondaryColor('#d74f0b')
                ->to('web@kerigan.com');

        $mail = new KMAMail($message);
        $mail->send();
    }

    public function sendBounceback()
    {
        $headers  = 'MIME-Version: 1.0' . PHP_EOL;
        $headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;

        $message = new Message();
        $message->setHeadline('Thank you for trusting Big Fish Construction')
                ->setBody($this->messageBody('We\'ve received your request. Here\'s a copy of what you submitted. We\'ll be in touch soon!' ))
                ->setHeaders($headers)
                ->setSubject('Your Plans & Permitting Request')
                ->setPrimaryColor('#b73838')
                ->setSecondaryColor('#d74f0b')
                ->to($this->email);

        $mail = new KMAMail($message);
        $mail->send();
    }

    public function messageBody( $introText )
    {
        return '
        <p>'.$introText.'</p>' .
        $this->formInformation();
    }

    public function formInformation()
    {
        return '
        <table cellspacing="0" cellpadding="0" border="0" class="datatable">
            <tr><td>Name</td><td>' . $this->name . '</td></tr>
            <tr><td>Email</td><td>' . $this->email . '</td></tr>
            <tr><td>Max Buildable Width</td><td>' . $this->maxWidth . '</td></tr>
            <tr><td>Max Buildable Depth</td><td>' . $this->maxDepth . '</td></tr>
            <tr><td>Number of Bedrooms</td><td>' . $this->bedrooms . '</td></tr>
            <tr><td>Number of Bathrooms</td><td>' . $this->bathrooms . '</td></tr>
            <tr><td>Elevator</td><td>' . $this->elevator . '</td></tr>
            <tr><td>Flood Zone</td><td>' . $this->floodZone . '</td></tr>
            <tr><td>AdditionalInformation</td><td>' . $this->comments  . '</td></tr>
        </table>
        ';
    }

    public function validate($name, $email)
    {
        if ($name === null) {
            return new \WP_Error('name_required', 'The name field is required', ['status' => 422]);
        }
        if ($email === null) {
            return new \WP_Error('email_required', 'The email field is required', ['status' => 422]);
        }
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // invalid email given
            return new \WP_Error('invalid_email', 'The email address you entered is invalid', ['status' => 422]);
        }

        $this->name = $name;
        $this->email = $email;

        return false;
    }
}
