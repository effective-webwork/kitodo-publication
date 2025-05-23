class MessageController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController 
{
    /**
     * @var \EWW\Dpf\Domain\Repository\MessageRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject  
     */
    protected $messageRepository;

    /**
     * @var \EWW\Dpf\Services\Email\Notifier
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $notifier;

    /**
     * Zeigt alle fehlgeschlagenen Nachrichten an
     */
    public function listAction()
    {
        $messages = $this->messageRepository->findAll();
        $this->view->assign('messages', $messages);
    }

    /**
     * Wiederholt das Senden einer Nachricht
     *
     * @param \EWW\Dpf\Domain\Model\Message $message
     */
    public function retryAction(Message $message)
    {
        $success = $this->notifier->retryMessage($message);
        
        if ($success) {
            $this->addFlashMessage(
                'Die Nachricht wurde erfolgreich erneut gesendet.',
                '',
                \TYPO3\CMS\Core\Messaging\AbstractMessage::OK
            );
        } else {
            $this->addFlashMessage(
                'Das erneute Senden der Nachricht ist fehlgeschlagen.',
                '',
                \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR  
            );
        }

        $this->redirect('list');
    }
}