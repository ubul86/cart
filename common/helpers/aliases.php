<?php
namespace common\helpers;

function encode($text)
{
    return yii\helpers\Html::encode($text);
}

function abort_404($message = null)
{
    throw new \yii\web\NotFoundHttpException($message);
}

/**
 * Visszaadja a Yii-t.
 * @return Yii::$app;
 */
function yii()
{
    return Yii::$app;
}

/**
 * Response
 * @return \yii\web\Response|\yii\console\Response
 */
function response()
{
    return Yii::$app->response;
}

/**
 * Beállítja, hogy a response JSON legyen.
 */
function json_response()
{
    response()->format = \yii\web\Response::FORMAT_JSON;
}

/**
 * Visszaadja az urlt
 * 
 * @param array $params
 * @return string
 */
function route($params, $sheme = false)
{
    return \yii\helpers\Url::to($params, $sheme);
}


/**
 * Visszaadja a sessiont.
 * 
 * @return yii\web\Session
 */
function session()
{
    return yii()->session;
}

/**
 * Visszaadja a requestet.
 * 
 * @return yii\web\Request
 */
function request()
{
    return yii()->request;
}

/**
 * Post kérések elérése egyszerűbben.
 * 
 * @param string $key
 * @param mixed $default
 * @return array|null
 */
function post($key = null, $default = null)
{

    if (is_null($key)) {
        return request()->post();
    }

    return request()->post($key, $default);
}

/**
 * Get kérések elérése egyszerűbben
 * 
 * @param string $key
 * @param mixed $default
 * @return array|null
 */
function get($key = null, $default = null)
{

    if (is_null($key)) {
        return request()->get();
    }

    return request()->get($key, $default);
}

/**
 * Visszaadja az auth modult.
 * 
 * @return yii\web\User
 */
function auth()
{
    return yii()->user;
}

/**
 * Auth user elérése egyszerűbben.
 * 
 * @return common\models\User
 */
function auth_user()
{
    return auth()->identity;
}

function unique_string($length=32){
    return yii()->security->generateRandomKey($length);
}