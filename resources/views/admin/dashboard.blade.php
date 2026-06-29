<h1>{{ $header }}</h1>
@extends('admin::index')

@section('content')
    <div class="row">
        <!-- 会员数据面板 -->
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">会员数据</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <!-- 注册数量 -->
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h5 class="card-title">注册数量</h5>
                                </div>
                                <div class="card-body">
                                    <h2>{{ $registeredCount }}</h2>
                                </div>
                            </div>
                        </div>

                        <!-- 各等级会员数量 -->
                        <div class="col-md-6">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h5 class="card-title">各等级会员数量</h5>
                                </div>
                                <div class="card-body">
                                    <div id="levelChart" style="height: 200px;"></div>
                                    <script>
                                        var levelCounts = {!! json_encode($levelCounts) !!};
                                        var levelData = levelCounts.map(item => ({
                                            name: item.level,
                                            value: item.count
                                        }));
                                        var chart = echarts.init(document.getElementById('levelChart'));
                                        var option = {
                                            title: {
                                                text: '会员等级分布'
                                            },
                                            series: [{
                                                name: '会员等级',
                                                type: 'pie',
                                                data: levelData
                                            }]
                                        };
                                        chart.setOption(option);
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 经营数据面板 -->
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">经营数据</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <!-- 今日登录数量 -->
                        <div class="col-md-4">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h5 class="card-title">今日登录</h5>
                                </div>
                                <div class="card-body">
                                    <h3>{{ $todayLogins }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- 今日下单数量 -->
                        <div class="col-md-4">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h5 class="card-title">今日下单</h5>
                                </div>
                                <div class="card-body">
                                    <h3>{{ $todayOrders }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- 今日兑换数量 -->
                        <div class="col-md-4">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h5 class="card-title">今日兑换</h5>
                                </div>
                                <div class="card-body">
                                    <h3>{{ $todayRedemptions }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- 本周登录数量 -->
                        <div class="col-md-4">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h5 class="card-title">本周登录</h5>
                                </div>
                                <div class="card-body">
                                    <h3>{{ $weekLogins }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- 本周下单数量 -->
                        <div class="col-md-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h5 class="card-title">本周下单</h5>
                                </div>
                                <div class="card-body">
                                    <h3>{{ $weekOrders }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- 本周兑换数量 -->
                        <div class="col-md-4">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h5 class="card-title">本周兑换</h5>
                                </div>
                                <div class="card-body">
                                    <h3>{{ $weekRedemptions }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 积分数据面板 -->
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">积分数据</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <!-- 回收积分总数 -->
                        <div class="col-md-4">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h5 class="card-title">回收积分总数</h5>
                                </div>
                                <div class="card-body">
                                    <h3>{{ $totalPoints }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- 捐赠积分总数 -->
                        <div class="col-md-4">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h5 class="card-title">捐赠积分总数</h5>
                                </div>
                                <div class="card-body">
                                    <h3>{{ $donatedPoints }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- 兑换积分总数 -->
                        <div class="col-md-4">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h5 class="card-title">兑换积分总数</h5>
                                </div>
                                <div class="card-body">
                                    <h3>{{ $totalSpentPoints }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 商品数据面板 -->
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">商品数据</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <!-- 商品浏览量 -->
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h5 class="card-title">商品浏览量</h5>
                                </div>
                                <div class="card-body">
                                    <div id="productViewsChart" style="height: 200px;"></div>
                                    <script>
                                        var productViews = {!! json_encode($productViews) !!};
                                        var productViewsData = productViews.map(item => ({
                                            name: item.name,
                                            value: item.viewing_count
                                        }));
                                        var chart = echarts.init(document.getElementById('productViewsChart'));
                                        var option = {
                                            title: {
                                                text: '商品浏览量'
                                            },
                                            series: [{
                                                name: '浏览量',
                                                type: 'bar',
                                                data: productViewsData
                                            }]
                                        };
                                        chart.setOption(option);
                                    </script>
                                </div>
                            </div>
                        </div>

                        <!-- 商品兑换量 -->
                        <div class="col-md-6">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h5 class="card-title">商品兑换量</h5>
                                </div>
                                <div class="card-body">
                                    <div id="productRedemptionsChart" style="height: 200px;"></div>
                                    <script>
                                        var productRedemptions = {!! json_encode($productRedemptions) !!};
                                        var productRedemptionsData = productRedemptions.map(item => ({
                                            name: item.name,
                                            value: item.redemption_count
                                        }));
                                        var chart = echarts.init(document.getElementById('productRedemptionsChart'));
                                        var option = {
                                            title: {
                                                text: '商品兑换量'
                                            },
                                            series: [{
                                                name: '兑换量',
                                                type: 'bar',
                                                data: productRedemptionsData
                                            }]
                                        };
                                        chart.setOption(option);
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- 订单数据面板 -->
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">订单数据</h3>
                </div>
                <div class="box-body">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">订单状态分布</h5>
                        </div>
                        <div class="card-body">
                            <div id="orderStatusChart" style="height: 200px;"></div>
                            <script>
                                var orderStatusCounts = {!! json_encode($orderStatusCounts) !!};
                                var orderStatusData = orderStatusCounts.map(item => ({
                                    name: item.status,
                                    value: item.count
                                }));
                                var chart = echarts.init(document.getElementById('orderStatusChart'));
                                var option = {
                                    title: {
                                        text: '订单状态分布'
                                    },
                                    series: [{
                                        name: '订单状态',
                                        type: 'pie',
                                        data: orderStatusData
                                    }]
                                };
                                chart.setOption(option);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 取件人管理 -->
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">取件人管理</h3>
                </div>
                <div class="box-body">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">取件人数量</h5>
                        </div>
                        <div class="card-body">
                            <h3>{{ $collectorCount }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
