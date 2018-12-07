<?php
declare(strict_types=1);

/**
 * @author tjitse (Vendic)
 * Created on 07/12/2018 09:28
 */

namespace Vendic\CheckoutOnly\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Settings
{
    const XML_ALLOWED_IPS = 'checkout_only_settings/general/allowed_ips';
    const XML_ALLOWED_LAYOUT_HANDLES = 'checkout_only_settings/general/allowed_layout_handles';
    const XML_ALLOWED_URLS = 'checkout_only_settings/general/allowed_urls';
    const XML_REDIRCT_URL = 'checkout_only_settings/general/redirect_url';
    const XML_ENABLED = 'checkout_only_settings/general/enable';
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function getAllowedIps(): array
    {
        $allowedIps = $this->getValue(self::XML_ALLOWED_IPS);
        return $this->splitToArray($allowedIps);
    }

    public function getAllowedLayoutHandles(): array
    {
        $layoutHandles = $this->getValue(self::XML_ALLOWED_LAYOUT_HANDLES);
        return $this->splitToArray($layoutHandles);
    }

    public function getAllowedUrls(): array
    {
        $allowedUrls = $this->getValue(self::XML_ALLOWED_URLS);
        return $this->splitToArray(($allowedUrls));
    }

    public function getRedirectUrl(): string
    {
        return $this->getValue(self::XML_REDIRCT_URL);
    }

    public function getIsEnabled(): bool
    {
        return (bool)$this->getValue(self::XML_ENABLED);
    }

    protected function getValue(string $xmlPath)
    {
        return $this->scopeConfig->getValue($xmlPath, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    protected function splitToArray($value = null): array
    {
        if (!$value) {
            return [];
        }

        $output = [];
        $array = explode("\n", $value);

        if (count($array) < 1) {
            return $array;
        }

        foreach ($array as $item) {
            $output[] = trim($item);
        }

        return $output;
    }
}
