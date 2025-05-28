<?php
namespace EWW\Dpf\Services\Logger;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use EWW\Dpf\Domain\Repository\ClientRepository;
use TYPO3\CMS\Core\Log\LogLevel;
use TYPO3\CMS\Core\Log\LogManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Logger class provides functionality for managing log entries across various log levels.
 * It relies on a repository system to enrich log messages with client-specific data.
 *
 * @method emergency($message, $context = [])
 * @method alert($message, $context = [])
 * @method critical($message, $context = [])
 * @method error($message, $context = [])
 * @method warning($message, $context = [])
 * @method notice($message, $context = [])
 * @method info($message, $context = [])
 * @method debug($message, $context = [])
 */
class LoggerOld
{
    /** @var ClientRepository */
    protected $clientRepository;

    /** @var $logger \TYPO3\CMS\Core\Log\Logger */
    protected $logger;

    private $logLevels = [
        'emergency' => LogLevel::EMERGENCY,
        'alert' => LogLevel::ALERT,
        'critical' => LogLevel::CRITICAL,
        'error' => LogLevel::ERROR,
        'warning' => LogLevel::WARNING,
        'notice' => LogLevel::NOTICE,
        'info' => LogLevel::INFO,
        'debug' => LogLevel::DEBUG,
    ];


    /**
     * @param string $componentClass
     */
    public function __construct($componentClass = '')
    {
        $this->clientRepository = GeneralUtility::makeInstance(ClientRepository::class);
        $this->logger = GeneralUtility::makeInstance(LogManager::class)->getLogger($componentClass);
    }

    /**
     * @param string $componentClass
     * @return LoggerOld
     */
    public static function getLogger($componentClass = ''): LoggerOld
    {
        if (empty($componentClass)) {
            $backtrace = debug_backtrace();
            if (isset($backtrace[1]['class'])) {
                $componentClass = $backtrace[1]['class'];
            } else {
                $componentClass = __CLASS__;
            }
        }

        return new LoggerOld($componentClass);
    }

    /**
     * @param int $level
     * @param string $message
     * @param array $context
     * @return void
     */
    public function log($level, $message, $context = [])
    {
        /*
        $client = $this->clientRepository->findAll()->current();

        if ($client) {
            $context['client'] = $client->getUid();
        } else {
            throw new \Exception('Error: No client found.');
        }
        */
        $this->logger->log($level, $message, $context);
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return void
     */
    public function __call($name, $arguments) {
        $logLevel = strtolower(str_replace('log', '', $name));

        if (isset($this->logLevels[$logLevel])) {
            $level = $this->logLevels[$logLevel];
            $this->log($level, ...$arguments);
        } else {
            throw new \BadMethodCallException("Method {$name} does not exist.");
        }
    }
}
