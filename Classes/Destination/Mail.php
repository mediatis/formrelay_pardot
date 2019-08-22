<?php

namespace Mediatis\FormrelayMail\Destination;

use Mediatis\Formrelay\Destination\AbstractDestination;
use Mediatis\FormrelayMail\DataDispatcher\MailDispatcher;

class Mail extends AbstractDestination
{
    protected function getExtensionKey(): string
    {
        return 'tx_formrelay_mail';
    }

    protected function getDispatcher(array $conf, array $data, array $context)
    {
        $recipients = $conf['recipients'];
        $sender = $conf['sender'];
        $subject = $conf['subject'];

        $valueDelimiter = $conf['valueDelimiter'];
        $lineDelimiter = $conf['lineDelimiter'];
        $includeAttachmentsInMail = $conf['includeAttachmentsInMail'];

        $mailDispatcher = $this->objectManager->get(
            MailDispatcher::class,
            $recipients,
            $sender,
            $subject,
            $valueDelimiter,
            $lineDelimiter,
            $includeAttachmentsInMail
        );
        return $mailDispatcher;
    }
}
