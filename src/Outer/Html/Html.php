<?php

namespace Devtools\Docgen\Outer\Html;

use Devtools\Docgen\Entity\Api;
use Devtools\Docgen\Outer\Base;

class Html extends Base
{
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function out()
    {
        $stream = $this->config['stream'] ?? 'php://stdout';
        if ($stream != 'php://stdout' && !is_file($stream)) {
            @mkdir(dirname($stream), 0777, true);
        }
        $fileHandle = fopen($stream, "w");
        $apisJsonData = $this->getApisJsonData();
        $content = str_replace('{{apisJsonData}}', $apisJsonData, file_get_contents(__DIR__ . '/api.tpl'));
        fwrite($fileHandle, $content);
        fclose($fileHandle);
        return $stream;
    }

    public function getApisJsonData()
    {
        $jsonConfig = [
            'playground' => [
                'enable' => true,
            ],
            'optimized' => false,
            'stylesheets' => [],
            'sidebar' => [
                'groupOrder' => 'auto'
            ],
            'basePath' => '/'
        ];
        $overview = $this->getOverview();
        $apis = $this->getApis();
        $divideToGroups = [];
        $tags = [];
        $actions = [];
        $tagActions = [];
        foreach ($apis as $api) {
            $divideToGroups[$api->getGroup()][] = $api;
        }
        foreach ($divideToGroups as $groupName => $groupApis) {
            if (empty($groupName)) {
                $groupName = '未定义组';
            }

            $tmp = [
                'title' => $groupName,
                'description' => '',
                'children' => [],
            ];
            $tags[] = $tmp;

            /**
             * @var $groupApi Api
             */
            $tagActionsChildrenActions = [];
            foreach ($groupApis as $groupApi) {
                $parameters = [];
                $groupApiParams = $groupApi->getParams();
                foreach ($groupApiParams as $gParam) {
                    $parameters[] = [
                        'location' => 'path',
                        'name' => $gParam['name'],
                        'description' => $gParam['desc'],
                        'required' => $gParam['required'],
                        'example' => '',
                        'schema' => [
                            'type' => strtolower($gParam['param_type'])
                        ]
                    ];
                }
                $actions[] = [
                    'title' => $groupApi->getTitle(),
                    'path' => $groupApi->getUri(),
                    'pathTemplate' => $groupApi->getUri(),
                    'slug' => $groupApi->getTitle() . '~' . $groupApi->getMethod() . '~' . $groupApi->getUri(),
                    'method' => $groupApi->getMethod(),
                    'description' => $groupApi->getTitle(),
                    'parameters' => $parameters,
                    'transactions' => [
                        [
                            'request' => [
                                'title' => '',
                                'description' => $groupApi->getRemarkBefore(),
                                'headers' => '',
                                'example' => $groupApi->getExampleRequest(),
                                'schema' => '',
                            ],
                            'response' => [
                                'statusCode' => 200,
                                'title' => '',
                                'description' => $groupApi->getRemarkAfter(),
                                'contentType' => 'application/json',
                                'headers' => '',
                                'example' => $groupApi->getExampleResponse(),
                                'schema' => ''
                            ],
                        ]
                    ],
                    'tags' => [$groupName]
                ];
                $tagActionsChildrenActions[] = [
                    'title' => $groupApi->getTitle(),
                    'method' => $groupApi->getMethod(),
                    'path' => $groupApi->getUri(),
                    'slug' => $groupApi->getTitle() . '~' . $groupApi->getMethod() . '~' . $groupApi->getUri(),
                ];
            }
            $tagActions[0]['children'][] = [
                'title' => $groupName,
                'actions' => $tagActionsChildrenActions
            ];
        }

        $apiConfig = [
            'title' => $overview->getTitle(),
            'description' => $overview->getDescription(),
            'version' => '',
            'servers' => [],
            'tags' => $tags,
            'actions' => $actions,
            'tagActions' => $tagActions
        ];
        return json_encode([
                'config' => $jsonConfig
            ] + $apiConfig, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
