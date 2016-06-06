GloryAdminBundle
====

GloryAdminBundle 基于 Symfony，使用 AdminLTE 前端而开发的后台管理

使用
----

### Composer
```sh
composer require foreverglory/admin-bundle
```
or
add composer.json file, after `composer update`
```json
{
    require: {
        "foreverglory/theme-bundle": "dev-master"
    }
}
```

### Kernel
```php
//app/AppKernel.php
public function registerBundles()
{
    return array(
        // require bundles
        new Sp\BowerBundle\SpBowerBundle(),
        new Glory\Bundle\SettingBundle\GlorySettingBundle(),
        new Glory\Bundle\MenuBundle\GloryMenuBundle(),
        new Glory\Bundle\WebBundle\GloryWebBundle(),
        // core bundle
        new Glory\Bundle\AdminBundle\GloryAdminBundle(),
        // more ...
    );
}
```

### Conﬁgure
```yaml
#app/conﬁg/conﬁg.yml
sp_bower:
    bundles:
        # 启用 bower 资源
        GloryAdminBundle: ~
glory_setting: ~
glory_menu: ~
glory_admin:
    # css,js资源，将替换默认
    stylesheets: ~
    javascripts: ~
    # 仪表盘配置
    dashboard:
        - { include: AppBundle:Block:analysis.html.twig }
        - { controller: AppBundle:Dashboard:calendar }
        # more ...
```

```yaml
#app/config/routing.yml
glory_admin:
    resource: "@GloryAdminBundle/Resources/config/routing.yml"
    prefix:   /
```

```yaml
#app/config/security.yml
security:
    access_control:
        - { path: ^/admin, role: ROLE_ADMIN }
```

### Data
- install assetic
```sh
php app/console sp:bower:install
```
- install menu database
```sh
php app/console gloryadmin:install menu
```

Enjoy it
----
