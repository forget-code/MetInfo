<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class china_bank {
    
    public function bank_json() {
        $bank_json = '{
                        "103": {
                          "id": "103",
                          "type": "cash",
                          "name": "中国工商银行",
                          "code": "ABC"
                        },
                        "104": {
                          "id": "104",
                          "type": "cash",
                          "name": "中国银行",
                          "code": "BOC"
                        },
                        "106": {
                          "id": "106",
                          "type": "cash",
                          "name": "中国银行",
                          "code": "BOC"
                        },
                        "302": {
                          "id": "302",
                          "type": "cash",
                          "name": "宁波银行",
                          "code": "NBCB"
                        },
                        "303": {
                          "id": "303",
                          "type": "cash",
                          "name": "宁波银行",
                          "code": "NBCB"
                        },
                        "305": {
                          "id": "305",
                          "type": "cash",
                          "name": "中国民生银行",
                          "code": "CMBC"
                        },
                        "306": {
                          "id": "306",
                          "type": "cash",
                          "name": "广东发展银行",
                          "code": "GDB"
                        },
                        "307": {
                          "id": "307",
                          "type": "cash",
                          "name": "平安银行",
                          "code": "PAB"
                        },
                        "308": {
                          "id": "308",
                          "type": "cash",
                          "name": "招商银行",
                          "code": "CMB"
                        },
                        "309": {
                          "id": "309",
                          "type": "cash",
                          "name": "兴业银行",
                          "code": "CIB"
                        },
                        "310": {
                          "id": "310",
                          "type": "cash",
                          "name": "北京银行",
                          "code": "BOB"
                        },
                        "311": {
                          "id": "311",
                          "type": "cash",
                          "name": "华夏银行",
                          "code": "HXB"
                        },
                        "312": {
                          "id": "312",
                          "type": "cash",
                          "name": "光大银行",
                          "code": "CEB"
                        },
                        "313": {
                          "id": "313",
                          "type": "cash",
                          "name": "中信银行",
                          "code": "CITIC"
                        },
                        "314": {
                          "id": "314",
                          "type": "cash",
                          "name": "上海浦东发展银行",
                          "code": "SPDB"
                        },
                        "316": {
                          "id": "316",
                          "type": "cash",
                          "name": "南京银行",
                          "code": "NJCB"
                        },
                        "317": {
                          "id": "317",
                          "type": "cash",
                          "name": "渤海银行",
                          "code": "CBHB"
                        },
                        "324": {
                          "id": "324",
                          "type": "cash",
                          "name": "杭州银行",
                          "code": "HZB"
                        },
                        "326": {
                          "id": "326",
                          "type": "cash",
                          "name": "上海银行",
                          "code": "BOS"
                        },
                        "334": {
                          "id": "334",
                          "type": "cash",
                          "name": "青岛银行",
                          "code": "QDCCB"
                        },
                        "335": {
                          "id": "335",
                          "type": "cash",
                          "name": "北京农商银行",
                          "code": "BJRCB"
                        },
                        "336": {
                          "id": "336",
                          "type": "cash",
                          "name": "成都银行",
                          "code": "BOCD"
                        },
                        "342": {
                          "id": "342",
                          "type": "cash",
                          "name": "重庆农商银行",
                          "code": "CQRCB"
                        },
                        "343": {
                          "id": "343",
                          "type": "cash",
                          "name": "上海农商行",
                          "code": "SRCB"
                        },
                        "344": {
                          "id": "344",
                          "type": "cash",
                          "name": "恒丰银行",
                          "code": "EGB"
                        },
                        "401": {
                          "id": "401",
                          "type": "cash",
                          "name": "厦门银行",
                          "code": "BOXM"
                        },
                        "402": {
                          "id": "402",
                          "type": "cash",
                          "name": "陕西信合",
                          "code": "SHXNX"
                        },
                        "403": {
                          "id": "403",
                          "type": "cash",
                          "name": "浙江稠州银行",
                          "code": "CZCB"
                        },
                        "404": {
                          "id": "404",
                          "type": "cash",
                          "name": "贵州农信",
                          "code": "GZNX"
                        },
                        "1025": {
                          "id": "1025",
                          "type": "cash",
                          "name": "中国工商银行",
                          "code": "ICBC"
                        },
                        "1027": {
                          "id": "1027",
                          "type": "cash",
                          "name": "中国工商银行",
                          "code": "ICBC"
                        },
                        "1031": {
                          "id": "1031",
                          "type": "cash",
                          "name": "农业银行",
                          "code": "ABC"
                        },
                        "1051": {
                          "id": "1051",
                          "type": "cash",
                          "name": "中国建设银行",
                          "code": "CCB"
                        },
                        "1054": {
                          "id": "1054",
                          "type": "cash",
                          "name": "中国建设银行",
                          "code": "CCB"
                        },
                        "3011": {
                          "id": "3011",
                          "type": "cash",
                          "name": "交通银行",
                          "code": "BCM"
                        },
                        "3051": {
                          "id": "3051",
                          "type": "cash",
                          "name": "中国民生银行",
                          "code": "CMBC"
                        },
                        "3061": {
                          "id": "3061",
                          "type": "cash",
                          "name": "广东发展银行",
                          "code": "GDB"
                        },
                        "3071": {
                          "id": "3071",
                          "type": "cash",
                          "name": "平安银行",
                          "code": "PAB"
                        },
                        "3080": {
                          "id": "3080",
                          "type": "cash",
                          "name": "招商银行",
                          "code": "CMB"
                        },
                        "3091": {
                          "id": "3091",
                          "type": "cash",
                          "name": "兴业银行",
                          "code": "CIB"
                        },
                        "3101": {
                          "id": "3101",
                          "type": "cash",
                          "name": "北京银行",
                          "code": "BOB"
                        },
                        "3112": {
                          "id": "3112",
                          "type": "cash",
                          "name": "华夏银行",
                          "code": "HXB"
                        },
                        "3121": {
                          "id": "3121",
                          "type": "cash",
                          "name": "光大银行",
                          "code": "CEB"
                        },
                        "3131": {
                          "id": "3131",
                          "type": "cash",
                          "name": "中信银行",
                          "code": "CITIC"
                        },
                        "3141": {
                          "id": "3141",
                          "type": "cash",
                          "name": "上海浦东发展银行",
                          "code": "SPDB"
                        },
                        "3230": {
                          "id": "3230",
                          "type": "cash",
                          "name": "邮政储蓄银行",
                          "code": "PSBC"
                        },
                        "3231": {
                          "id": "3231",
                          "type": "cash",
                          "name": "邮政储蓄银行",
                          "code": "PSBC"
                        },
                        "3241": {
                          "id": "3241",
                          "type": "cash",
                          "name": "杭州银行",
                          "code": "HZB"
                        },
                        "3261": {
                          "id": "3261",
                          "type": "cash",
                          "name": "上海银行",
                          "code": "BOS"
                        },
                        "3341": {
                          "id": "3341",
                          "type": "cash",
                          "name": "青岛银行",
                          "code": "QDCCB"
                        },
                        "3407": {
                          "id": "3407",
                          "type": "cash",
                          "name": "交通银行",
                          "code": "BCM"
                        },
                        "4031": {
                          "id": "4031",
                          "type": "cash",
                          "name": "浙江稠州银行",
                          "code": "CZCB"
                        }
                      }';
        return $bank_json;
    }
    
    public function bank_array() {
        $bank_array = array(
            '1025' => array(
                    'id'   => '1025',
                    'type' => 'cash',
                    'name' => '中国工商银行',
                    'code' => 'ICBC'
                    ),
            '1051' => array(
                    'id'   => '1051',
                    'type' => 'cash',
                    'name' => '中国建设银行',
                    'code' => 'CCB'
                    ),
            '104'  => array(
                    'id'   => '104',
                    'type' => 'cash',
                    'name' => '中国银行',
                    'code' => 'BOC'
                    ),
            '103' => array(
                    'id'   => '103',
                    'type' => 'cash',
                    'name' => '中国工商银行',
                    'code' => 'ABC'
                    ),
            '3407' => array(
                    'id'   => '3407',
                    'type' => 'cash',
                    'name' => '交通银行',
                    'code' => 'BCM'
                    ),
            '3230' => array(
                    'id'   => '3230',
                    'type' => 'cash',
                    'name' => '邮政储蓄银行',
                    'code' => 'PSBC'
                    ),
            '3080' => array(
                    'id'   => '3080',
                    'type' => 'cash',
                    'name' => '招商银行',
                    'code' => 'CMB'
                    ),
            '313' => array(
                    'id'   => '313',
                    'type' => 'cash',
                    'name' => '中信银行',
                    'code' => 'CITIC'
                    ),
            '314' => array(
                    'id'   => '314',
                    'type' => 'cash',
                    'name' => '上海浦东发展银行',
                    'code' => 'SPDB'
                    ),
            '309' => array(
                    'id'   => '309',
                    'type' => 'cash',
                    'name' => '兴业银行',
                    'code' => 'CIB'
                    ),
            '305' => array(
                    'id'   => '305',
                    'type' => 'cash',
                    'name' => '中国民生银行',
                    'code' => 'CMBC'
                    ),
            '312' => array(
                    'id'   => '312',
                    'type' => 'cash',
                    'name' => '光大银行',
                    'code' => 'CEB'
                    ),
            '307' => array(
                    'id'   => '307',
                    'type' => 'cash',
                    'name' => '平安银行',
                    'code' => 'PAB'
                    ),
            '311' => array(
                    'id'   => '311',
                    'type' => 'cash',
                    'name' => '华夏银行',
                    'code' => 'HXB'
                    ),
            '310' => array(
                    'id'   => '310',
                    'type' => 'cash',
                    'name' => '北京银行',
                    'code' => 'BOB'
                    ),
            '3061' => array(
                    'id'   => '3061',
                    'type' => 'cash',
                    'name' => '广东发展银行',
                    'code' => 'GDB'
                    ),
            '326' => array(
                    'id'   => '326',
                    'type' => 'cash',
                    'name' => '上海银行',
                    'code' => 'BOS'
                    ),
            '335' => array(
                    'id'   => '335',
                    'type' => 'cash',
                    'name' => '北京农商银行',
                    'code' => 'BJRCB'
                    ),
            '342' => array(
                    'id'   => '342',
                    'type' => 'cash',
                    'name' => '重庆农商银行',
                    'code' => 'CQRCB'
                    ),
            '343' => array(
                    'id'   => '343',
                    'type' => 'cash',
                    'name' => '上海农商行',
                    'code' => 'SRCB'
                    ),
            '316' => array(
                    'id'   => '316',
                    'type' => 'cash',
                    'name' => '南京银行',
                    'code' => 'NJCB'
                    ),
            '302' => array(
                    'id'   => '302',
                    'type' => 'cash',
                    'name' => '宁波银行',
                    'code' => 'NBCB'
                    ),
            '324' => array(
                    'id'   => '324',
                    'type' => 'cash',
                    'name' => '杭州银行',
                    'code' => 'HZB'
                    ),
            '336' => array(
                    'id'   => '336',
                    'type' => 'cash',
                    'name' => '成都银行',
                    'code' => 'BOCD'
                    ),
            '3341' => array(
                    'id'   => '3341',
                    'type' => 'cash',
                    'name' => '青岛银行',
                    'code' => 'QDCCB'
                    ),
            '344' => array(
                    'id'   => '344',
                    'type' => 'cash',
                    'name' => '恒丰银行',
                    'code' => 'EGB'
                    ),
            '317' => array(
                    'id'   => '317',
                    'type' => 'cash',
                    'name' => '渤海银行',
                    'code' => 'CBHB'
                    ),
            '401' => array(
                    'id'   => '401',
                    'type' => 'cash',
                    'name' => '厦门银行',
                    'code' => 'BOXM'
                    ),
            '402' => array(
                    'id'   => '402',
                    'type' => 'cash',
                    'name' => '陕西信合',
                    'code' => 'SHXNX'
                    ),
            '403' => array(
                    'id'   => '403',
                    'type' => 'cash',
                    'name' => '浙江稠州银行',
                    'code' => 'CZCB'
                    ),
            '404' => array(
                    'id'   => '404',
                    'type' => 'cash',
                    'name' => '贵州农信',
                    'code' => 'GZNX'
                    ),
            //
            '1027' => array(
                    'id'   => '1027',
                    'type' => 'credit',
                    'name' => '中国工商银行',
                    'code' => 'ICBC'
                    ),
            '1054' => array(
                    'id'   => '1054',
                    'type' => 'credit',
                    'name' => '中国建设银行',
                    'code' => 'CCB'
                    ),
            '106' => array(
                    'id'   => '106',
                    'type' => 'credit',
                    'name' => '中国银行',
                    'code' => 'BOC'
                    ),
            '1031' => array(
                    'id'   => '1031',
                    'type' => 'credit',
                    'name' => '农业银行',
                    'code' => 'ABC'
                    ),
            '3011' => array(
                    'id'   => '3011',
                    'type' => 'credit',
                    'name' => '交通银行',
                    'code' => 'BCM'
                    ),
            '3231' => array(
                    'id'   => '3231',
                    'type' => 'credit',
                    'name' => '邮政储蓄银行',
                    'code' => 'PSBC'
                    ),
            '308' => array(
                    'id'   => '308',
                    'type' => 'credit',
                    'name' => '招商银行',
                    'code' => 'CMB'
                    ),
            '3131' => array(
                    'id'   => '3131',
                    'type' => 'credit',
                    'name' => '中信银行',
                    'code' => 'CITIC'
                    ),
            '3141' => array(
                    'id'   => '3141',
                    'type' => 'credit',
                    'name' => '上海浦东发展银行',
                    'code' => 'SPDB'
                    ),
            '3091' => array(
                    'id'   => '3091',
                    'type' => 'credit',
                    'name' => '兴业银行',
                    'code' => 'CIB'
                    ),
            '3051' => array(
                    'id'   => '3051',
                    'type' => 'credit',
                    'name' => '中国民生银行',
                    'code' => 'CMBC'
                    ),
            '3121' => array(
                    'id'   => '3121',
                    'type' => 'credit',
                    'name' => '光大银行',
                    'code' => 'CEB'
                    ),
            '3071' => array(
                    'id'   => '3071',
                    'type' => 'credit',
                    'name' => '平安银行',
                    'code' => 'PAB'
                    ),
            '3112' => array(
                    'id'   => '3112',
                    'type' => 'credit',
                    'name' => '华夏银行',
                    'code' => 'HXB'
                    ),
            '306' => array(
                    'id'   => '306',
                    'type' => 'credit',
                    'name' => '广东发展银行',
                    'code' => 'GDB'
                    ),
            '3261' => array(
                    'id'   => '3261',
                    'type' => 'credit',
                    'name' => '上海银行',
                    'code' => 'BOS'
                    ),
            '303' => array(
                    'id'   => '303',
                    'type' => 'credit',
                    'name' => '宁波银行',
                    'code' => 'NBCB'
                    ),
            '3241' => array(
                    'id'   => '3241',
                    'type' => 'credit',
                    'name' => '杭州银行',
                    'code' => 'HZB'
                    ),
            '334' => array(
                    'id'   => '334',
                    'type' => 'credit',
                    'name' => '青岛银行',
                    'code' => 'QDCCB'
                    ),
            '3101' => array(
                    'id'   => '3101',
                    'type' => 'credit',
                    'name' => '北京银行',
                    'code' => 'BOB'
                    ),
            '4031' => array(
                    'id'   => '4031',
                    'type' => 'credit',
                    'name' => '浙江稠州银行',
                    'code' => 'CZCB'
                    )
        );
        return $bank_array;
    }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>