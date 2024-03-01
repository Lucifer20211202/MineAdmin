<?php

declare(strict_types=1);
/**
 * This file is part of MineAdmin.
 *
 * @link     https://www.mineadmin.com
 * @document https://doc.mineadmin.com
 * @contact  root@imoi.cn
 * @license  https://github.com/mineadmin/MineAdmin/blob/master/LICENSE
 */
use Hyperf\Stringable\Str;

beforeEach(function () {
    $this->prefix = '/system/apiGroup';
});

test('Api Group get test', function () {
    $this->actionTest([
        $this->buildTest('getNoParamsTest') => 'index',
        $this->buildTest('getNoParamsTest') => 'list',
        $this->buildTest('getNoParamsTest') => 'recycle',
    ]);
    $this->remoteTest();
});

test('Api Group put test', function () {
    $successParam = [
        'name' => Str::random(5),
    ];
    $failParams = [
        [],
    ];
    $updateSuccessParam = [
        'name' => Str::random(5),
    ];
    $updateFailParams = [
        [],
    ];
    $id = $this->saveAndUpdate($successParam, $failParams, $updateSuccessParam, $updateFailParams);
    $this->actionTest([
        $this->buildTest('getNoParamsTest') => 'read/' . $id,
    ]);

    $this->changeStatusTest($id);
    $this->recoveryAndDeleteTest([$id]);
});
