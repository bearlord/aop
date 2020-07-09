<?php
/**
 * ESD framework Aop
 * @author albert <63851587@qq.com>
 * @author tmtbe <896369042@qq.com>
 * @author bearlord <565364226@qq.com>
 */

namespace ESD\Aop;

/**
 * Class FunctionProxy
 * @package ESD\Aop
 */
class FunctionProxy extends \Go\Proxy\FunctionProxy
{
    public function __toString()
    {
        $functionsCode = (
            $this->namespace->getDocComment() . "\n" . // Doc-comment for file
            'namespace ' . // 'namespace' keyword
            $this->namespace->getName() . // Name
            ";\n" . // End of namespace name
            implode("\n", $this->functionsCode) // Function definitions
        );

        return $functionsCode
            // Inject advices on call
            . PHP_EOL
            . '\\' . __CLASS__ . "::injectJoinPoints('"
            . $this->namespace->getName() . "',"
            . var_export($this->advices, true) . ');';
    }
}