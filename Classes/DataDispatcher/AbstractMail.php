<?php

namespace Mediatis\FormrelayMail\DataDispatcher;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Michael Vöhringer (Mediatis AG) <voehringer@mediatis.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Log\Logger;
use TYPO3\CMS\Core\Log\LogManager;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Mail\Rfc822AddressesParser;
use TYPO3\CMS\Core\Utility\GeneralUtility;

abstract class AbstractMail implements \Mediatis\Formrelay\DataDispatcherInterface
{
    protected $recipients;
    protected $sender;
    protected $subject;
    protected $includeAttachmentsInMail;

    /** @var Logger */
    protected $logger;

    /**
     * @var MailMessage
     */
    protected $mailMessage;

    public function __construct($recipients, $sender, $subject, $includeAttachmentsInMail = false)
    {
        $this->recipients = $recipients;
        $this->sender = $sender;
        $this->subject = $subject;
        $this->includeAttachmentsInMail = $includeAttachmentsInMail;
        $this->mailMessage = GeneralUtility::makeInstance(MailMessage::class);
        $this->logger = GeneralUtility::makeInstance(LogManager::class)->getLogger(__CLASS__);
    }

    /**
     * @param $data
     * @param bool|array $attachments
     * @return bool|int
     */
    public function send($data, $attachments = false)
    {
        $retval = true;

        GeneralUtility::devLog('Mediatis\\Formrelay\\DataDispatcher\\AbstractMail::send()', __CLASS__, 0, $data);

        $subject = $this->getSubject($data);
        $this->mailMessage->setSubject($this->sanitizeHeaderString($subject));

        $senderEmails = $this->filterValidEmails($this->getFrom($data));
        if (!empty($senderEmails)) {
            $this->mailMessage->setFrom($senderEmails);
        }

        $recipientEmails = $this->filterValidEmails($this->getTo($data));
        if (!empty($recipientEmails)) {
            $this->mailMessage->setTo($recipientEmails);
        }

        $plainContent = $this->getPlainTextContent($data);
        $htmlContent = $this->getHtmlContent($data);
        if ($htmlContent) {
            $this->mailMessage->setBody($htmlContent, 'text/html');
            if ($plainContent) {
                $this->mailMessage->addPart($plainContent, 'text/plain');
            }
        } elseif ($plainContent) {
            $this->mailMessage->setBody($plainContent, 'text/plain');
        }

        if (!empty($attachments) && $this->includeAttachmentsInMail) {
            foreach ($attachments as $attachment) {
                try {
                    $this->mailMessage->attach(\Swift_Attachment::fromPath($attachment));
                } catch (\Exception $e) {
                    $this->logError('Formrelay Mail Error: ' . $e->getMessage());
                }
            }
        }
        if ($this->mailMessage->getTo() && $this->mailMessage->getBody()) {
            $retval = $this->mailMessage->send();
        }

        return $retval;
    }

    protected function getSubject($data)
    {
        return $this->subject;
    }

    /**
     * Checks string for suspicious characters
     *
     * @param string $string String to check
     * @return string Valid or empty string
     */
    protected function sanitizeHeaderString($string)
    {
        $pattern = '/[\\r\\n\\f\\e]/';
        if (preg_match($pattern, $string) > 0) {
            $this->dirtyHeaders[] = $string;
            $string = '';
        }
        return $string;
    }

    /**
     * Filter input-string for valid email addresses
     *
     * @param string $emails If this is a string, it will be checked for one or more valid email addresses.
     * @return array List of valid email addresses
     */
    protected function filterValidEmails($emails)
    {
        if (!is_string($emails)) {
            // No valid addresses - empty list
            return [];
        }

        /** @var $addressParser Rfc822AddressesParser */
        $addressParser = GeneralUtility::makeInstance(Rfc822AddressesParser::class, $emails);
        $addresses = $addressParser->parseAddressList();

        $validEmails = [];
        foreach ($addresses as $address) {
            $fullAddress = $address->mailbox . '@' . $address->host;
            if (GeneralUtility::validEmail($fullAddress)) {
                if ($address->personal) {
                    $validEmails[$fullAddress] = $address->personal;
                } else {
                    $validEmails[] = $fullAddress;
                }
            }
        }
        return $validEmails;
    }

    protected function getFrom($data)
    {
        return $this->sender;
    }

    protected function getTo($data)
    {
        return $this->recipients;
    }

    abstract protected function getPlainTextContent($data);

    abstract protected function getHtmlContent($data);

    protected function renderEmailAddress($email, $name = '')
    {
        if ($name) {
            return $name . ' <' . $email . '>';
        }
        return $email;
    }

    protected function logError($message)
    {
        $this->logger->error($message);
    }
}
