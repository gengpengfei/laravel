# 支持的支付方法

支付宝支付目前支持 6 中支付方法，对应的支付 method 如下：

| method | 说明 | 参数 | 返回值 |
| :---: | :---: | :---: | :---: |
| web | 电脑支付 | array $order | Response |
| wap | 手机网站支付 | array $order | Response |
| app | APP 支付 | array $order | Response |
| pos | 刷卡支付 | array $order | Collection |
| scan | 扫码支付 | array $order | Collection |
| transfer | 账户转账 | array $order | Collection |

# 使用方法

## 一、电脑支付

### 例子

```php
$order = [
    'out_trade_no' => time(),
    'total_amount' => '0.01',
    'subject'      => 'test subject-测试订单',
];

return $alipay->web($order)->send(); // laravel 框架中请直接 return $alipay->web($order)
```

### 订单配置参数

**所有订单配置中，客观参数均不用配置，扩展包已经为大家自动处理了，比如，**`product_code`** 等参数。**

所有订单配置参数和官方无任何差别，兼容所有功能，所有参数请参考[这里](https://docs.open.alipay.com/270/alipay.trade.page.pay)，查看「请求参数」一栏。

## 二、手机网站支付

### 例子

```php
$order = [
    'out_trade_no' => time(),
    'total_amount' => '0.01',
    'subject'      => 'test subject-测试订单',
];

return $alipay->wap($order)->send(); // laravel 框架中请直接 return $alipay->wap($order)
```

### 订单配置参数

**所有订单配置中，客观参数均不用配置，扩展包已经为大家自动处理了，比如，**`product_code`** 等参数。**

所有订单配置参数和官方无任何差别，兼容所有功能，所有参数请参考[这里](https://docs.open.alipay.com/203/107090/)，查看「请求参数」一栏。

## 三、APP 支付

### 例子

```php
$order = [
    'out_trade_no' => time(),
    'total_amount' => '0.01',
    'subject'      => 'test subject-测试订单',
];

// 将返回字符串，供后续 APP 调用，调用方式不在本文档讨论范围内，请参考官方文档。
return $alipay->app($order)->send(); // laravel 框架中请直接 return $alipay->app($order)
```

### 订单配置参数

**所有订单配置中，客观参数均不用配置，扩展包已经为大家自动处理了，比如，**`product_code`** 等参数。**

所有订单配置参数和官方无任何差别，兼容所有功能，所有参数请参考[这里](https://docs.open.alipay.com/204/105465/)，查看「请求参数」一栏。

## 四、刷卡支付

### 例子

```php
$order = [
    'out_trade_no' => time(),
    'total_amount' => '0.01',
    'subject'      => 'test subject-刷卡支付',
    'auth_code' => '289756915257123456',
];

$result = $alipay->pos($order);
```

### 订单配置参数

**所有订单配置中，客观参数均不用配置，扩展包已经为大家自动处理了，比如，**`product_code`** 等参数。**

所有订单配置参数和官方无任何差别，兼容所有功能，所有参数请参考[这里](https://docs.open.alipay.com/api_1/alipay.trade.pay)，查看「请求参数」一栏。

## 五、扫码支付

### 例子

```php
$order = [
    'out_trade_no' => time(),
    'total_amount' => '0.01',
    'subject'      => 'test subject-刷卡支付',
];

$result = $alipay->scan($order);
//二维码内容： $qr = $result->qr_code;
```

### 订单配置参数

**所有订单配置中，客观参数均不用配置，扩展包已经为大家自动处理了，比如，**`product_code`** 等参数。**

所有订单配置参数和官方无任何差别，兼容所有功能，所有参数请参考[这里](https://docs.open.alipay.com/api_1/alipay.trade.precreate)，查看「请求参数」一栏。

## 六、转账

### 例子

```php
$order = [
    'out_biz_no' => time(),
    'payee_type' => 'ALIPAY_LOGONID',
    'payee_account' => 'ghdhjw7124@sandbox.com',
    'amount' => '0.01',
];

$result = $alipay->transfer($order);
```

### 订单配置参数

**所有订单配置中，客观参数均不用配置，扩展包已经为大家自动处理了，比如，**`product_code`** 等参数。**

所有订单配置参数和官方无任何差别，兼容所有功能，所有参数请参考[这里](https://docs.open.alipay.com/api_28/alipay.fund.trans.toaccount.transfer)，查看「请求参数」一栏。

# 返回值

**各支付方法返回值请参考「支持的支付方法」一节。**

返回只会返回两种类型 `Symfony\Component\HttpFoundation\Response` 或 `Yansongda\Supports\Collection`

* 返回 Response 类型时，可以通过 `return $response->send()` 直接进行返回（laravel 框架中使用请直接`return $response` ）
* 返回 Collection 类型时，可以通过 `$collection->xxx` 得到服务器返回的数据。 

# 异常

* Yansongda\Pay\Exceptions\InvalidSignException ，表示验签失败。
* Yansongda\Pay\Exceptions\GatewayException ，表示支付宝服务器返回的数据非正常结果，例如，参数错误等。
* Yansongda\Pay\Exceptions\InvalidConfigException ，表示缺少配置参数，如，`ali_public_key`, `private_key` 等



