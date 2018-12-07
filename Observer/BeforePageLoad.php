<?php
declare(strict_types=1);

/**
 * @author tjitse (Vendic)
 * Created on 06/12/2018 16:30
 */

namespace Vendic\CheckoutOnly\Observer;

use Magento\Framework\App\Area;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\ResponseFactory;
use Magento\Framework\App\State;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\UrlInterface;
use Vendic\CheckoutOnly\Model\Config\Settings;

class BeforePageLoad implements ObserverInterface
{
    /**
     * @var ResponseFactory
     */
    protected $responseFactory;
    /**
     * @var State
     */
    protected $state;
    /**
     * @var Http
     */
    protected $request;
    /**
     * @var UrlInterface
     */
    protected $url;
    /**
     * @var Settings
     */
    protected $settings;
    /**
     * @var RemoteAddress
     */
    protected $remoteAddress;

    public function __construct(
        RemoteAddress $remoteAddress,
        Settings $settings,
        UrlInterface $url,
        Http $request,
        State $state,
        ResponseFactory $responseFactory
    ) {
        $this->responseFactory = $responseFactory;
        $this->state = $state;
        $this->request = $request;
        $this->url = $url;
        $this->settings = $settings;
        $this->remoteAddress = $remoteAddress;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        // IP guard
        if ($this->isIpAllowed()) {
            return;
        }

        // Enabled guard
        if (!$this->isEnabled()) {
            return;
        }

        // Frontend guard
        if (!$this->isFrontend()) {
            return;
        }

        // Page type guard
        if ($this->isPageTypeAllowed()) {
            return;
        }

        // Url guard
        if ($this->isUrlAllowed()) {
            return;
        }

        $response = $this->responseFactory->create();
        $response->setRedirect($this->getRedirectUrl())->sendResponse();
        die;
    }

    protected function isFrontend()
    {
        if ($this->state->getAreaCode() === Area::AREA_FRONTEND) {
            return true;
        }
        return false;
    }

    protected function isPageTypeAllowed()
    {
        $handle = $this->request->getFullActionName();
        if (in_array($handle, $this->settings->getAllowedLayoutHandles())) {
            return true;
        }
        return false;
    }

    public function getRedirectUrl()
    {
        return $this->settings->getRedirectUrl();
    }

    protected function isUrlAllowed()
    {
        $currentUrl = $this->url->getCurrentUrl();
        foreach ($this->settings->getAllowedUrls() as $allowedUrl) {
            if (strpos($currentUrl, trim($allowedUrl))) {
                return true;
            }
        }
        return false;
    }

    protected function isEnabled(): bool
    {
        return $this->settings->getIsEnabled();
    }

    protected function isIpAllowed() : bool
    {
        $allowedIps = $this->settings->getAllowedIps();
        $visitorIp = $this->remoteAddress->getRemoteAddress();

        if (in_array($visitorIp, $allowedIps)) {
            return true;
        }

        return false;
    }
}
