<?php

namespace Devtools\Docgen\Helper;

class Str
{
    /**
     * 下划线路径转化为驼峰路径
     *
     * @param string $str 路径
     *
     * @return string
     */
    public static function underscoresToCamelCase($str)
    {
        return preg_replace_callback(
            '#([/_])([^/_]*)#',
            function ($match) {
                switch ($match[1]) {
                    case '/':
                        return '/' . ucfirst($match[2]);
                    case '_':
                        return ucfirst($match[2]);
                }
            },
            '_' . $str
        );
    }

    /**
     * 驼峰路径转化为下划线路径
     *
     * @param string $str 路径
     *
     * @return string
     */
    public static function camelCaseToUnderscores($str)
    {
        return substr(preg_replace_callback(
            '#(/?)([A-Z])#',
            function ($match) {
                switch ($match[1]) {
                    case '/':
                        return '/' . strtolower($match[2]);
                    default:
                        return '_' . strtolower($match[2]);
                }
            },
            '/' . $str
        ), 1);
    }

    /**
     * Determine if a given string starts with a given substring.
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    public static function startsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle !== '' && substr($haystack, 0, strlen($needle)) === (string) $needle) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given string ends with a given substring.
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    public static function endsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if (substr($haystack, -strlen($needle)) === (string) $needle) {
                return true;
            }
        }

        return false;
    }
}