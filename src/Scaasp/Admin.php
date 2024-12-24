<?php

namespace Guolei19850528\Laravel\Wisharetec\Scaasp;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class Admin
{
    /**
     * @var string
     */
    protected string $baseUrl = '';

    /**
     * @var string
     */
    protected string $username = '';

    /**
     * @var string
     */
    protected string $password = '';

    /**
     * @var array|Collection|null
     */
    protected array|Collection|null $tokenData = null;

    public function getBaseUrl(): string
    {
        if (\str($this->baseUrl)->endsWith('/')) {
            return \str($this->baseUrl)->substr(0, -1)->toString();
        }
        return $this->baseUrl;
    }

    public function setBaseUrl(string $baseUrl): Admin
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): Admin
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): Admin
    {
        $this->password = $password;
        return $this;
    }

    public function getTokenData(): array|Collection|null
    {
        return \collect($this->tokenData);
    }

    public function setTokenData(array|Collection|null $tokenData): Admin
    {
        $this->tokenData = \collect($tokenData);
        return $this;
    }

    public function __construct(
        string $username = '',
        string $password = '',
        string $baseUrl = 'https://sq.wisharetec.com/'
    )
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setBaseUrl($baseUrl);
        $this->setTokenData(\collect());
    }

    public function loginState(
        array|Collection|null $query = null,
        array|Collection|null $headers = null,
        string                $url = '/old/serverUserAction!checkSession.action',
        array|Collection|null $urlParameters = [],
        array|Collection|null $options = [],
        \Closure|null         $responseHandler = null
    )
    {
        $query = \collect($query);
        $headers = \collect($headers);
        $options = \collect($options);
        $urlParameters = \collect($urlParameters);
        \data_fill($headers, 'Token', \data_get($this->getTokenData(), 'token', ''));
        \data_fill($headers, 'Companycode', \data_get($this->getTokenData(), 'companyCode', ''));
        $response = Http::baseUrl($this->getBaseUrl())
            ->withOptions($options->toArray())
            ->withHeaders($headers->toArray())
            ->withUrlParameters($urlParameters->toArray())
            ->get($url, $query->toArray());
        if ($responseHandler instanceof \Closure) {
            return \value($responseHandler($response));
        }
        if ($response->ok()) {
            return \str($response->body())->lower()->trim()->startsWith('null');
        }
        return false;
    }

    public function login(
        array|Collection|null $data = [],
        array|Collection|null $headers = [],
        string                $url = '/manage/login',
        array|Collection|null $urlParameters = [],
        array|Collection|null $options = [],
        \Closure|null         $responseHandler = null
    ): Admin
    {
        $data = \collect($data);
        $headers = \collect($headers);
        $options = \collect($options);
        $urlParameters = \collect($urlParameters);
        \data_fill($data, 'username', $this->getUsername());
        \data_fill($data, 'password', \md5($this->getPassword()));
        \data_fill($data, 'mode', 'PASSWORD');
        $response = Http::baseUrl($this->getBaseUrl())
            ->asForm()
            ->withHeaders($headers->toArray())
            ->withOptions($options->toArray())
            ->withUrlParameters($urlParameters->toArray())
            ->post($url, $data->toArray());
        if ($responseHandler instanceof \Closure) {
            return \value($responseHandler($response));
        }
        if ($response->ok()) {
            $json = $response->json();
            if (Validator::make($json, ['status' => 'required|integer|size:100'])->messages()->isEmpty()) {
                $this->setTokenData(\collect(\data_get($json, 'data', [])));
            }
        }
        return $this;
    }

    public function loginWithCache(
        string                                    $key = '',
        \DateTimeInterface|\DateInterval|int|null $ttl = null,
        array|Collection|null                     $loginStateFunArgs = [],
        array|Collection|null                     $loginFunArgs = []
    ): Admin
    {
        $loginFunArgs = \collect($loginFunArgs);
        $loginStateFunArgs = \collect($loginStateFunArgs);
        if (\str($key)->isEmpty()) {
            $key = \str('laravel_wisharetec_scaasp_admin')->append('_token_', $this->getUsername())->toString();
        }
        if (\cache()->has($key)) {
            $this->setTokenData(\collect(\cache()->get($key, [])));
        }
        if (!$this->loginState(...$loginStateFunArgs->toArray())) {
            $this->login(...$loginFunArgs->toArray());
            \cache()->put($key, $this->getTokenData(), $ttl);
        }
        return $this;
    }

    /**
     * request with token
     * @param string|null $method request method
     * @param string|null $url request url
     * @param array|Collection|null $urlParameters request urlParameters
     * @param array|Collection|null $data request data
     * @param array|Collection|null $query request query
     * @param array|Collection|null $headers request headers
     * @param array|Collection|null $options request options
     * @param \Closure|null $responseHandler response handler
     * @return mixed
     * @throws \Exception
     */
    public function requestWithToken(
        string|null           $method = 'GET',
        string|null           $url = '',
        array|Collection|null $urlParameters = [],
        array|Collection|null $data = [],
        array|Collection|null $query = [],
        array|Collection|null $headers = [],
        array|Collection|null $options = [],
        \Closure|null         $responseHandler = null
    ): mixed
    {
        $method = \str($method)->isEmpty() ? 'GET' : $method;
        $data = \collect($data);
        $query = \collect($query);
        $headers = \collect($headers);
        $urlParameters = \collect($urlParameters);
        $options = \collect($options);
        \data_fill($options, RequestOptions::FORM_PARAMS, $data->toArray());
        \data_fill($options, RequestOptions::QUERY, $query->toArray());
        \data_fill($headers, 'Token', \data_get($this->getTokenData(), 'token', ''));
        \data_fill($headers, 'Companycode', \data_get($this->getTokenData(), 'companyCode', ''));
        $response = Http::baseUrl($this->getBaseUrl())
            ->withHeaders($headers->toArray())
            ->withUrlParameters($urlParameters->toArray())
            ->send($method, $url, $options->toArray());
        if ($responseHandler instanceof \Closure) {
            return \value($responseHandler($response));
        }
        if ($response->ok()) {
            $json = $response->json();
            if (Validator::make($json, ['status' => 'required|integer|size:100'])->messages()->isEmpty()) {
                return \collect(\data_get($json, 'data', []));
            }
        }
        return \collect();
    }
}
