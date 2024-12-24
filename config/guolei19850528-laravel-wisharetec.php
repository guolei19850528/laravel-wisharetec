<?php
/**
 * 作者:郭磊
 * 邮箱:174000902@qq.com
 * 电话:15210720528
 * Git:https://github.com/guolei19850528/laravel-wisharetec
 */
return [
    'scaasp' => [
        'admin' => [
            'urls' => [
                'base' => 'https://sq.wisharetec.com/',
                'login' => '/manage/login',
                'query_login_state' => '/old/serverUserAction!checkSession.action',
                'query_community_with_paginator' => '/manage/communityInfo/getAdminCommunityList',
                'query_community_detail' => '/manage/communityInfo/getCommunityInfo',
                'query_room_with_paginator' => '/manage/communityRoom/listCommunityRoom',
                'query_room_detail' => '/manage/communityRoom/getFullRoomInfo',
                'query_room_export' => '/manage/communityRoom/exportDelayCommunityRoomList',
                'query_register_user_with_paginator' => '/manage/user/register/list',
                'query_register_user_detail' => '/manage/user/register/detail',
                'query_register_user_export' => '/manage/user/register/list/export',
                'query_register_owner_with_paginator' => '/manage/user/information/register/list',
                'query_register_owner_detail' => '/manage/user/information/register/detail',
                'query_register_owner_export' => '/manage/user/information/register/list/export',
                'query_unregister_owner_with_paginator' => '/manage/user/information/unregister/list',
                'query_unregister_owner_detail' => '/manage/user/information/unregister/detail',
                'query_unregister_owner_export' => '/manage/user/information/unregister/list/export',
                'query_shop_goods_category_with_paginator' => '/manage/productCategory/getProductCategoryList',
                'query_shop_goods_with_paginator' => '/manage/shopGoods/getAdminShopGoods',
                'query_shop_goods_detail' => '/manage/shopGoods/getShopGoodsDetail',
                'save_shop_goods' => '/manage/shopGoods/saveSysShopGoods',
                'update_shop_goods' => '/manage/shopGoods/updateShopGoods',
                'query_shop_goods_push_to_store' => '/manage/shopGoods/getGoodsStoreEdits',
                'save_shop_goods_push_to_store' => '/manage/shopGoods/saveGoodsStoreEdits',
                'query_store_product_with_paginator' => '/manage/storeProduct/getAdminStoreProductList',
                'query_store_product_detail' => '/manage/storeProduct/getStoreProductInfo',
                'update_store_product' => '/manage/storeProduct/updateStoreProductInfo',
                'update_store_product_status' => '/manage/storeProduct/updateProductStatus',
                'query_business_order_with_paginator' => '/manage/businessOrderShu/list',
                'query_business_order_detail' => '/manage/businessordershu/view',
                'query_business_order_export_1' => '/manage/businessOrder/exportToExcelByOrder',
                'query_business_order_export_2' => '/manage/businessOrder/exportToExcelByProduct',
                'query_business_order_export_3' => '/manage/businessOrder/exportToExcelByOrderAndProduct',
                'query_work_order_with_paginator' => '/old/orderAction!viewList.action',
                'query_work_order_detail' => '/old/orderAction!view.action',
                'query_work_order_export' => '/manage/order/work/export',
                'query_parking_auth_with_paginator' => '/manage/carParkApplication/carParkCard/list',
                'query_parking_auth_detail' => '/manage/carParkApplication/carParkCard',
                'update_parking_auth' => '/manage/carParkApplication/carParkCard',
                'query_parking_auth_audit_with_paginator' => '/manage/carParkApplication/carParkCard/parkingCardManagerByAudit',
                'query_parking_auth_audit_check_with_paginator' => '/manage/carParkApplication/getParkingCheckList',
                'update_parking_auth_audit_status' => '/manage/carParkApplication/completeTask',
                'query_export_with_paginator' => '/manage/export/log',
                'upload' => '/upload',
            ],
            'accounts' => [
                'your key' => [
                    'baseUrl' => 'https://sq.wisharetec.com/',
                    'username' => '',
                    'password' => '',
                ]
            ],
        ]
    ]
];
