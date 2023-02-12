<?php

namespace Arch\Infrastructure\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(ExceptionEvent $event)
    {
        if ($event->getThrowable() instanceof NotFoundHttpException) {
          /*  dump('eto');
            die();*/
        }
        if ($event->getThrowable() instanceof \ErrorException) {
            dd('error occurred!');
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.exception' => 'onKernelException',
        ];
    }
}
