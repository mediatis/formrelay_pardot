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
use TYPO3\CMS\Core\Mail\Rfc822AddressesParser;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Mail implements \Mediatis\Formrelay\DataDispatcherInterface
{
    protected $recipients;
    protected $sender;
    protected $subject;

    /**
     * @var \TYPO3\CMS\Core\Mail\MailMessage
     */
    protected $mailMessage;

    public function __construct($recipients, $sender, $subject)
    {
        $this->recipients = $recipients;
        $this->sender = $sender;
        $this->subject = $subject;
        $this->mailMessage = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Mail\MailMessage::class);
    }

    public function send($data)
    {
        $retval = true;

        GeneralUtility::devLog('Mediatis\\Formrelay\\DataDispatcher\\Mail::send()', __CLASS__, 0, $data);

        $this->mailMessage->setSubject($this->sanitizeHeaderString($this->subject));
        $this->mailMessage->setFrom($this->sanitizeHeaderString($this->sender));

        $validEmails = $this->filterValidEmails($this->recipients);
        if (!empty($validEmails)) {
            $this->mailMessage->setTo($validEmails);
        }

        $plainContent = $this->getPlainTextContetn($data);
        $this->mailMessage->setBody($plainContent, 'text/plain');

        if ($this->mailMessage->getTo() && $this->mailMessage->getBody()) {
            $retval = $this->mailMessage->send();
        }

        return $retval;
    }

    private function getPlainTextContetn($data)
    {
        $content = "";

        foreach ($data as $key => $value) {
            $content .= $key. '= '. $value .PHP_EOL;
        }
        return $content;
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
}
