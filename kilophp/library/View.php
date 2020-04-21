<?php/** * Created by KiloFrameWork * User: xiejiawei<print_f@hotmail.com> * Date: 2020/4/13 * Time: 8:43 */namespace kilophp;use Exception;use kilophp\view\driver\Twig;/** * 框架视图类 * @package kilophp * @author XieJiaWei<print_f@hotmail.com> * @version 1.0.0 */class View{    /**     * @var null |object 模板引擎实例     */    private static $_instance = null;    /**     * 获取模板引擎实例     * @static     * @access public     * @return Twig|object     * @throws \Exception     */    public static function instance()    {        if (is_null(self::$_instance)) {            //获取当前使用的模板引擎            $option = Config::get('template');            if (empty($option['type'])) {//没有定义驱动类型                throw new Exception(lang('no_view_type'));            } else {                $class = "kilophp\\view\\driver\\" . ucwords($option['type']);                if (class_exists($class)) {                    self::$_instance = new $class();                } else {                    throw new Exception(lang('no_view_driver', $option['type']));                }            }        }        return self::$_instance;    }    /**     * 静态调用模板引擎方法     * @access public     * @param $method     * @param $params     * @return object     * @throws \Exception     */    public static function __callStatic($method, $params)    {        return call_user_func_array([self::instance(), $method], $params);    }}