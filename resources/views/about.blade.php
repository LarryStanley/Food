@extends("default")

@section("head")

<link rel="stylesheet" href="/css/main.css">
<link rel="stylesheet" href="/css/about.css">

@stop

@section("content")
<div class="page" id="pageOne">
	<div class="container">
		<div class="center animated fadeIn" id="search">
			<div class="row">
				<div class="col-md-8 col-sm-8">
					<p>
						<div class="important">
							你<br>在美食的十字路口<span class="smallBreak"><br></span>迷失了嗎？<br>
							所有的<span class="smallBreak"><br></span>美食指南盡在
						</div>
						<div class="highlight">中大美食</div>
					</p>
				</div>
				<div class="col-md-4 col-sm-4 iphone">
					<img src="/image/one.png" alt="one" width="300px" style="margin-top: -150px;">
				</div>
			</div>
		</div>
	</div>
	<div class="animated fadeIn" id="downMessage" style="position: absolute; left: 50%; bottom:0; padding: 10px 10px 10px 10px;">
		<div style="position: relative; left: -50%; text-align:center">
			下拉查看詳細介紹<br><i class="fa fa-chevron-down"></i>
		</div>
	</div>
</div>
<div id="pageTwo">
	<div class="center" id="search">
		<h2>依種類查詢</h2>
		<div class="row" class="animated fadeIn">
			<div class="col-md-3 col-sm-3 col-xs-6 text-center">
				<a href="/breakfast" class="btn btn-default" style="color:white" target="blank">
					早餐<br>
					<i class='fa fa-coffee fa-4x'></i>
				</a>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6 text-center">
				<a href="/dine" class="btn btn-default" style="color:white" target="blank">
					午晚餐<br>
					<i class="fa fa-cutlery fa-4x"></i>
				</a>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6 text-center">
				<a href="/drink" class="btn btn-default" style="color:white" target="blank">
					飲料/點心<br>
					<i class="fa fa-glass fa-4x"></i>
				</a>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6 text-center">
				<a href="/midnight-snack" class="btn btn-default" style="color:white" target="blank">
					宵夜<br>
					<i class="fa fa-moon-o fa-4x"></i>
				</a>
			</div>
		</div>
		<p class="introduction">不管是早餐、宵夜、<span class="smallBreak"><br></span>飲料、點心<br>任何時候，<span class="smallBreak"><br></span>一切為您準備</p>
	</div>
</div>
<div id="pageThree">
	<div class="center">
		<p class="introduction">
			總是找不到店家電話？<br>
			想要事先點餐？<br>
		</p>
		<div class="well" style="padding: 0px 0px 0px 0px">
			<div id="info">
				<h2 itemprop="name">樂活堡</h2>
				<hr>
				<ul>
					<li itemprop="telephone">電話：(03) 420-3356</li>
					<li itemprop="address">
						地址：桃園縣中壢市中央路208號				</li>
					<li>類型：早餐</li>
					<li>外送：否</li>
					<li>備註：餐點內所含之胡椒粉，美乃滋或其他醬料若不需要，可於結帳時告知幫您特製</li>
				</ul>
			</div>
		</div>
		<p class="introduction">
			我們讓您<span class="smallBreak"><br></span>總是領先別人一步
		</p>
	</div>
</div>
<div id="pageFour">
	<div class="center" id="search">
		<h2>菜單資訊</h2>
		<p class="introduction">
			找同學代買，<span class="smallBreak"><br></span>卻不知菜單？<br>
			點餐一直都是這麼容易
		</p>
		<div class="well">
			<div id="menu">
			   <h3>菜單</h3>
			   <div id="0">
			      <a href="#" onclick="showMoreTable(0)">
			         <h4>超級堡餐</h4>
			      </a>
			      <p style="display: none;">包含堡類+美式炒蛋+附餐點心（任選**)+20元飲料<br>(**附餐點心任選:薯餅*2 or 薯條 or 小熱狗*6 or 雞塊 or 綜合)</p>
			      <table class="table table-striped table-hover" style="display: none;">
			         <thead>
			            <tr>
			               <td>品項</td>
			               <td>價錢</td>
			               <td>備註</td>
			            </tr>
			         </thead>
			         <tbody>
			            <tr>
			               <td>豪華雙魚起司堡餐</td>
			               <td>125</td>
			               <td></td>
			            </tr>
			            <tr>
			               <td>雙牛培根起司堡餐</td>
			               <td>145</td>
			               <td></td>
			            </tr>
			            <tr>
			               <td>雙層哈辣腿排堡餐</td>
			               <td>155</td>
			               <td></td>
			            </tr>
			         </tbody>
			      </table>
			   </div>
			   <div id="1">
			      <a href="#" onclick="showMoreTable(1)">
			         <h4>美式套餐</h4>
			      </a>
			      <p style="display: none;">包含肉類+沙拉+蛋(任選*)+香蒜切片+薯餅+20元飲料<br>(*蛋任選:荷包蛋 or 太陽蛋 or 歐姆蛋 or 美式炒蛋)</p>
			      <table class="table table-striped table-hover" style="display: none;">
			         <thead>
			            <tr>
			               <td>品項</td>
			               <td>價錢</td>
			               <td>備註</td>
			            </tr>
			         </thead>
			         <tbody>
			            <tr>
			               <td>火腿培根套餐</td>
			               <td>90</td>
			               <td></td>
			            </tr>
			            <tr>
			               <td>大市豬排套餐</td>
			               <td>90</td>
			               <td></td>
			            </tr>
			            <tr>
			               <td>手工豬肉套餐</td>
			               <td>90</td>
			               <td></td>
			            </tr>
			            <tr>
			               <td>卡拉脆雞套餐</td>
			               <td>109</td>
			               <td></td>
			            </tr>
			            <tr>
			               <td>哈辣脆雞套餐</td>
			               <td>109</td>
			               <td>辣</td>
			            </tr>
			         </tbody>
			      </table>
			   </div>
			   <div id="2">
			      <a href="#" onclick="showMoreTable(2)">
			         <h4>特調飲品</h4>
			      </a>
			      <p style="display: none;">本店飲品採用台糖二砂熬煮</p>
			      <table class="table table-striped table-hover" style="display: none;">
			         <thead>
			            <tr>
			               <td>品項</td>
			               <td>價錢</td>
			               <td>備註</td>
			            </tr>
			         </thead>
			         <tbody>
			            <tr>
			               <td>豆漿</td>
			               <td>中杯15 大杯20</td>
			               <td>冰/溫</td>
			            </tr>
			            <tr>
			               <td>紅茶</td>
			               <td>中杯15 大杯20</td>
			               <td>冰/溫</td>
			            </tr>
			            <tr>
			               <td>無糖冷泡綠茶</td>
			               <td>中杯15 大杯20</td>
			               <td>冰</td>
			            </tr>
			            <tr>
			               <td>奶茶</td>
			               <td>中杯15 大杯20</td>
			               <td>冰/溫</td>
			            </tr>
			            <tr>
			               <td>紅茶豆奶</td>
			               <td>中杯15 大杯20</td>
			               <td>冰/溫</td>
			            </tr>
			            <tr>
			               <td>鮮奶茶</td>
			               <td>中杯30 大杯45</td>
			               <td>冰/溫</td>
			            </tr>
			         </tbody>
			      </table>
			   </div>
			   <div id="3">
			      <a href="#" onclick="showMoreTable(3)">
			         <h4>樂活拼盤</h4>
			      </a>
			      <p style="display: none;">包含樂活組合拼盤+20元飲料</p>
			      <table class="table table-striped table-hover" style="display: none;">
			         <thead>
			            <tr>
			               <td>品項</td>
			               <td>價錢</td>
			               <td>備註</td>
			            </tr>
			         </thead>
			         <tbody>
			            <tr>
			               <td>樂活西式拼盤</td>
			               <td>75</td>
			               <td>芝士培根厚片+抹醬小厚片+手工豬肉排+炒蛋</td>
			            </tr>
			            <tr>
			               <td>樂活中式拼盤</td>
			               <td>75</td>
			               <td>蘿蔔糕+酥炸銀絲卷+大市豬排+培根佐太陽蛋</td>
			            </tr>
			            <tr>
			               <td>樂活素食拼盤</td>
			               <td>75</td>
			               <td>塔香玉米厚片+抹醬小厚片+酥香薯餅+歐姆蛋</td>
			            </tr>
			            <tr>
			               <td>樂活炸物拼盤</td>
			               <td>75</td>
			               <td>金黃脆薯+酥炸小熱狗+香酥雞塊+雙色厚片</td>
			            </tr>
			         </tbody>
			      </table>
			   </div>
			   <div id="4">
			      <a href="#" onclick="showMoreTable(4)">
			         <h4>丹麥吐司</h4>
			      </a>
			      <table class="table table-striped table-hover" style="display: none;">
			         <thead>
			            <tr>
			               <td>品項</td>
			               <td>價錢</td>
			               <td>備註</td>
			            </tr>
			         </thead>
			         <tbody>
			            <tr>
			               <td>火腿歐姆蛋</td>
			               <td>50</td>
			               <td></td>
			            </tr>
			            <tr>
			               <td>培根歐姆蛋</td>
			               <td>55</td>
			               <td></td>
			            </tr>
			            <tr>
			               <td>薯香歐姆蛋</td>
			               <td>55</td>
			               <td>素</td>
			            </tr>
			            <tr>
			               <td>鮪魚歐姆蛋</td>
			               <td>55</td>
			               <td></td>
			            </tr>
			            <tr>
			               <td>燻雞歐姆蛋</td>
			               <td>60</td>
			               <td></td>
			            </tr>
			         </tbody>
			      </table>
			   </div>
			   <script>$("#0").show();</script>
			</div>
		</div>
	</div>
</div>
<div id="pageFive">
	<div class="center">
		<h2 style="color: white">評論</h2>
		<p class="introduction">
			美食饗宴後的<span class="smallBreak"><br></span>精彩心得，等你分享
		</p>
		<div class="well" style="padding: 0px 0px 0px 0px;">
			<div id="comments" itemprop="review"><h3 itemprop="reviewBody">評論</h3><div id="likeArea"><a href="/login/捷捷廚房"><sapn id="like"><i class="fa fa-lg fa-thumbs-up"></i> <span class="counter">2</span> </sapn> </a><a href="/login/捷捷廚房"><span id="dislike"><i class="fa fa-lg fa-thumbs-down"></i><span class="counter">0</span></span></a></div><hr><div id="comment" class="container"><div class="row"><div class="col-sm-1"><a href="https://www.facebook.com/app_scoped_user_id/951991988173358/" target="_blank"><img src="http://graph.facebook.com/951991988173358/picture?type=square" class="img-circle" style="margin-top: 5px"></a></div><div class="col-sm-8"><a href="https://www.facebook.com/app_scoped_user_id/951991988173358/" target="_blank"><h4>Wu BoFan</h4></a><p>豪吃!</p></div></div></div><a class="btn btn-default" style="color: white" href="/login/捷捷廚房" target="blank">登入新增評論</a></div>
		</div>
	</div>
</div>
<div id="pageSix">
	<div class="center">
		<p class="important">立即免費使用</p>
		<p class="introduction">放心 <span class="smallBreak"><br></span>我們不會收取<span class="smallBreak"><br></span>您任何費用</p>
		<hr width="250">
		<a href="/login" id="facebookLoginButton">
			<i class="fa fa-facebook"></i> | 用Facebook登入
		</a><br><hr width="250">
		<a href="/" class="btn btn-default" style="color:white">不登入直接使用</a>
	</div>
</div>
@stop