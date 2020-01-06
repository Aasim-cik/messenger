<?php


namespace App\MessageHandler\Command;

use App\Message\Command\DeletePonkaToImage;
use App\Message\Event\ImagePostDeletedEvent;
use App\Photo\PhotoFileManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class deletePonkaToImageHandler implements MessageHandlerInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var MessageBusInterface
     */
    private $eventBus;


    public function __construct(EntityManagerInterface $entityManager, MessageBusInterface $eventBus)
    {

        $this->entityManager = $entityManager;
        $this->eventBus = $eventBus;
    }

    public function __invoke(DeletePonkaToImage $deletePonkaToImage)
    {
        $imagePost = $deletePonkaToImage->getImagePost();
        $filename = $imagePost->getFilename();

        $this->entityManager->remove($imagePost);
        $this->entityManager->flush();

        $this->eventBus->dispatch(new ImagePostDeletedEvent($filename));
    }

}