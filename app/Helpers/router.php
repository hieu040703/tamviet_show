    <?php
    use App\Models\Router;

    if (!function_exists('router_link')) {
        function router_link(string $module, int $objectId, $default = '#'): string
        {
            $router = Router::where('module', $module)->where('object_id', $objectId)->first();
            if (!$router) {
                return $default;
            }
            $canonical = rtrim($router->canonical, '/');
            if (!str_ends_with($canonical, '.html')) {
                $canonical .= '.html';
            }
            return url($canonical);
        }
    }
    if (!function_exists('router_link_from_canonical')) {
        function router_link_from_canonical(?string $canonical, $default = '#'): string
        {
            if (empty($canonical)) {
                return $default;
            }
            $canonical = rtrim($canonical, '/');
            if (!str_ends_with($canonical, '.html')) {
                $canonical .= '.html';
            }
            return url($canonical);
        }
    }
