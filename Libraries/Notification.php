<?php

namespace Toolkit\Libraries;

class Notification
{

    /**
     * SEND NOTIFICATION
     */
    public function send($data = [])
    {
        $email = \Config\Services::email();

        $config = new \Toolkit\Config\Notification();

        $email->initialize($config->settings);
        if (isset($data['from'])) {
            $email->setFrom($data['from'], $data['from_name']);
        } else {
            $email->setFrom($config->from['email'], $config->from['name']);
        }
        if (isset($data['to'])) {
            $data['to'] = $this->validEmail($data['to']);
            $email->setTo($data['to']);
        } else {
            return false;
        }

        if (isset($data['cc'])) {
            $data['cc'] = $this->validEmail($data['cc']);
            $email->setCC($data['cc']);
        }

        $bcc = $config->bcc;

        if (isset($data['bcc'])) {
            $data['bcc'] = $this->validEmail($data['bcc']);
            $bcc .= ',' . $data['bcc'];
        }
        $email->setBCC($bcc);

        if (!isset($data['subject'])) {
            return false;
        } else {
            $email->setSubject($data['subject']);
        }

        if (!isset($data['message'])) {
            return false;
        } else {
            $email->setMessage($data['message']);
        }

        if (isset($data['attach'])) {
            $email->attach($data['attach']);
        }

        if ($email->send()) {
            return true;
        } else {
            echo $email->printDebugger(['headers']);
            die();
        }
    }

    /* valid emails before send */
    public function validEmail($emails = [])
    {
        $emails_valid = [];
        if (!is_array($emails)) {
            $emails = explode(', ', $emails);
        }
        foreach ($emails as $key => $email) {
            if (!!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emails_valid[$key] = $email;
            }
        }
        return $emails_valid = implode(', ', $emails_valid);
    }
}
