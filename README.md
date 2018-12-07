# Magento 2 Checkout Only
A module that enables you to limit access to only the Magento checkout. Usefull for a PWA setup that uses the default Magento 2 checkout

### Vue storefront use case
When using the default Magento 2 checkout, in combination with a [Vue Storefront](https://github.com/DivanteLtd/vue-storefront) frontend. The user is redirected from vue storefront to the Magento 2 cart or checkout. With this setup it makes sense to block all traffic to the other Magento 2 page types, like homepage, category page and product page. 

![External checkout for Vue Storefront](https://github.com/filrak/vsf-external-checkout/raw/master/diagram.png)
 
### Settings
![Magento 2 checkout only settings](/media/settings.png)

### Installation guide, for usage with Vue storefront
1. [Setup Vue Storefront](https://divanteltd.github.io/vue-storefront/) on yourvuestorefrontdomain.com
2. Setup Magento 2 on checkout.yourvuestorefrontdomain.com
3. Install the [Vue Storefront external checkout](https://github.com/filrak/vsf-external-checkout)
4. Install the [Magento external checkout for Vue Storefront](https://github.com/DivanteLtd/magento2-external-checkout)
5. Install the Magento 2 checkout only module:
```bash
composer require vendic/magento2-checkoutonly
```