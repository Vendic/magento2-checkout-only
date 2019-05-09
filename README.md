# Magento 2 Checkout Only
A module that enables you to limit frontend access to only the Magento checkout. Usefull, for example, in a PWA setup that uses PWA for catalog viewing and Magento 2 for the checkout purposes.

**Disclaimer: This module isn't battletested yet, use with caution**

### Example use case: Vue storefront
When using the default Magento 2 checkout, in combination with a [Vue Storefront](https://github.com/DivanteLtd/vue-storefront) frontend. The user is redirected from vue storefront to the Magento 2 cart or checkout. With this setup it makes sense to block all traffic to the other Magento 2 page types, like homepage, category page and product page. 

![External checkout for Vue Storefront](https://github.com/filrak/vsf-external-checkout/raw/master/diagram.png)
 
### Settings
![Magento 2 checkout only settings](/media/settings.png)

### Installation guide, for usage with Vue storefront
1. [Setup Vue Storefront](https://divanteltd.github.io/vue-storefront/) on yourvuestorefrontdomain.com
2. Setup Magento 2 on checkout.yourvuestorefrontdomain.com
3. Install the [Vue Storefront external checkout](https://github.com/Vendic/vsf-external-checkout)
4. Install the [Magento external checkout for Vue Storefront](https://github.com/Vendic/magento2-external-checkout)
5. Install the Magento 2 checkout only module:

```bash
composer require vendic/magento2-checkoutonly
```

### About Vendic
[Vendic](https://www.vendic.nl "Vendic Homepage") develops technically challenging e-commerce websites using Magento 2, as well as innovative headless PWA shops. Feel free to check out our projects on our website.
