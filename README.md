#SERI API FOOD


## Câu lệnh
`
    php artisan make:resource CategoryResource => Tạo Resource
    php artisan make:resource CategoryCollection => Tạo Collection
`

## Mã lỗi
`
    200 : OK. The standard success code and default option.
    201 : Created. Object created. Useful for the store actions.
    204 : No Content. When the action was executed successfully, but there is no content to return.
    206 : Partial Content. Useful when you have to return a paginated list of resources.
    400 : Bad Request. The standard option for requests that cannot pass validation.
    401 : Unauthorized. The user needs to be authenticated.
    403 : Forbidden. The user is authenticated but does not have the permissions to perform an action.
    404 : Not Found. Laravel will return automatically when the resource is not found.
    500 : Internal Server Error. Ideally, you will not be explicitly returning this, but if something unexpected breaks, this is what your user is going to receive.
    503 : Service Unavailable. Pretty self-explanatory, but also another code that is not going to be returned explicitly by the application.
`

## KEY
`
    php artisan passport:keys --length=256 --force
`

##GIT
`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`
