<?php

namespace EWW\Dpf\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Message
 */
class Message extends AbstractEntity
{
    /**
     * @var string
     */
    protected $document = '';

    /**
     * @var string
     */
    protected $url = '';

    /**
     * @var string
     */
    protected $body = '';

    /**
     * @var string
     */
    protected $functionname = '';

    /**
     * @var string
     */
    protected $reason = '';

    /**
     * @var int
     */
    protected $tstamp = 0;


    /**
     * Get document
     *
     * @return Document
     */
    public function getDocument(): Document
    {
        return unserialize($this->document);
    }

    /**
     * Set document
     *
     * @param Document $document
     */
    public function setDocument($document): void
    {
        $this->document = serialize($document);
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Set body
     *
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * Get functionname
     *
     * @return string
     */
    public function getFunctionname(): string
    {
        return $this->functionname;
    }

    /**
     * Set functionname
     *
     * @param string $functionname
     */
    public function setFunctionname(string $functionname): void
    {
        $this->functionname = $functionname;
    }

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }

    /**
     * Set reason
     *
     * @param string $reason
     */
    public function setReason(string $reason): void
    {
        $this->reason = $reason;
    }

    /**
     * Get tstamp
     *
     * @return int
     */
    public function getTstamp(): int
    {
        return $this->tstamp;
    }

    /**
     * Set tstamp
     *
     * @param int $tstamp
     */
    public function setTstamp(int $tstamp): void
    {
        $this->tstamp = $tstamp;
    }


}

