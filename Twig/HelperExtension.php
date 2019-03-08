<?php

namespace EMS\ClientHelperBundle\Twig;

use EMS\ClientHelperBundle\Helper\Asset\AssetHelperRuntime;
use EMS\ClientHelperBundle\Helper\Asset\ProcessHelper;
use EMS\ClientHelperBundle\Helper\Elasticsearch\ClientRequestRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class HelperExtension extends AbstractExtension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('emsch_routing', [RoutingRuntime::class, 'transform'], ['is_safe' => ['html']]),
            new \Twig_SimpleFilter('emsch_data', [ClientRequestRuntime::class, 'data'], ['is_safe' => ['html']]),
            new TwigFilter('emsch_html_encode', [TextRuntime::class, 'html_encode'], ['is_safe' => ['html']]),
            new TwigFilter('emsch_anti_spam', [TextRuntime::class, 'html_encode_pii'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('emsch_admin_menu', [AdminMenuRuntime::class, 'showAdminMenu'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('emsch_route', [RoutingRuntime::class, 'createUrl']),
            new \Twig_SimpleFunction('emsch_search', [ClientRequestRuntime::class, 'search']),
            new \Twig_SimpleFunction('emsch_assets', [AssetHelperRuntime::class, 'assets']),
            new \Twig_SimpleFunction('emsch_unzip', [AssetHelperRuntime::class, 'unzip']),
            new \Twig_SimpleFunction('emsch_process_asset', [ProcessHelper::class, 'generate']),
        ];
    }
}
