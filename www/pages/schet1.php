<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<head>
		<title>test</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="../style.css" type="text/css" />
		<link rel="stylesheet" href="../pages.css" type="text/css" />
	</head>
	
<body>
<?
echo('
<div id="page">

<table id="schet">
	<tr>
		<td colspan=10 id="tdcenter"> Общество с ограниченной ответственностью "Навигатор" </td>
	</tr>
	
	<tr>
		<td colspan=10 id="tdcenter"> ИНН 6453104136 КПП 645201001      г.Саратов, пр. Строителей, 60, тел/факс (8452) 390077, 390078 </td>
	</tr>
	
	<tr>
		<td colspan=5 id="tdright"> Договор-заявка № </td>
		<td> '.$_GET["number"].' </td>
		<td> от </td>
		<td colspan=3 id="tdleft"> '.date("d.m.Y", strtotime($_GET["date"])).' </td>
	</tr>
	
	<tr>
		<td colspan=10 id="tdright"> ООО «Навигатор» именуемое в дальнейшем "Экспедитор" в лице директора Анджапаридзе С.А. </td>
	</tr>
	
	<tr>
		<td colspan=2> С одной стороны </td>
		<td colspan=4> '.$_GET["perevozchik"].' </td>
		<td colspan=4> именуемое в дальнейшем "Перевозчик"</td>
	</tr>
	
	<tr>
		<td id="tdleft"> в лице </td>
		<td colspan=2> </td>
		<td> '.$_GET["ati2"].' </td>
		<td> </td>
		<td id="tdright"> тел </td>
		<td colspan=2> </td>
		<td colspan=2> с другой стороны </td>
	</tr>
	
	<tr>
		<td colspan=10> заключили настоящий Договор о выполнении автоперевозки груза на следующих условиях: <hr> </td>
		
	</tr>	
	
	<tr class="withborder">
		<td colspan=5 id="tdcenter"> ПОГРУЗКА </td>
		<td colspan=5 id="tdcenter"> РАЗГРУЗКА </td>
	</tr>
	
	<tr class="withborder">
		<td colspan=2 rowspan=5> Адрес: </td>
		<td colspan=3 rowspan=5> '.$_GET["address_pogr"].' </td>
		<td colspan=2 rowspan=5> Адрес: </td>
		<td colspan=3 rowspan=5> '.$_GET["address_vig"].' </td>
	</tr>
	
	<tr> </tr>
	<tr> </tr>
	<tr> </tr>
	<tr> </tr>
	
	<tr class="withborder">
		<td colspan=2 id="tdleft"> Дата, время </td>
		<td colspan=3> '.date("d.m.Y", strtotime($_GET["date_pogr"])).' </td>
		<td colspan=2 id="tdleft"> Дата, время </td>
		<td colspan=3> '.date("d.m.Y", strtotime($_GET["date_vig"])).' </td>
	</tr>
	
	<tr class="withborder">
		<td colspan=2 id="tdleft"> Тел </td>
		<td colspan=3 id="tdleft"> '.$_GET["contact1"].' </td>
		<td colspan=2 id="tdleft"> Тел </td>
		<td colspan=3 id="tdleft"> '.$_GET["contact2"].' </td>
	</tr>
	
	<tr class="withborder">
		<td colspan=2 rowspan=2 id="tdleft"> Количество мест </td>
		<td colspan=3 rowspan=2 id="tdleft"> ТНП </td>
		<td colspan=2 rowspan=2 id="tdleft"> Требуемый подвижной состав: </td>
		<td colspan=3 rowspan=2 id="tdleft"> '.$_GET["podvizh"].' </td>
	</tr>
	
	<tr> </tr>
	
	<tr class="withborder">
		<td colspan=2 rowspan=3 id="tdleft"> Особые условия перевозки: </td>
		<td colspan=8 rowspan=3 id="tdleft"> '.$_GET["treb"].' </td>
	</tr>
	
	<tr> </tr>
	<tr> </tr>
	
	<tr class="withborder">
		<td colspan=2 id="tdleft"> Ставка за перевозку: </td>
		<td colspan=3 id="tdleft">  </td>
		<td colspan=2 id="tdleft"> Форма и срок: </td>
		<td colspan=3 id="tdleft"> по ОТТН б/н без НДС 3-5 б/дн </td>
	</tr>
	
	<tr class="withborder">
		<td colspan=2 rowspan=4 id="tdleft"> Водитель ФИО, тел, в/у </td>
		<td colspan=3 rowspan=4 id="tdleft">'.$_GET["driver"].' '.$_GET["phone1"].' '.$_GET["phone2"].' </td>
		<td colspan=2 id="tdleft"> Паспорт номер: </td>
		<td colspan=3 id="tdleft">  </td>
	</tr>
	
	<tr class="withborder">
		<td colspan=2 rowspan=3 id="tdleft"> Паспорт выдан: </td>
		<td colspan=3 rowspan=3 id="tdleft">  </td>
	</tr>
	
	<tr></tr>
	<tr></tr>
	
	<tr class="withborder">
		<td colspan=2 id="tdleft"> А/м марка, номер </td>
		<td colspan=3 id="tdleft"> '.$_GET["car"].' </td>
		<td colspan=2 id="tdleft"> П/прицеп </td>
		<td colspan=3 id="tdleft">  </td>
	</tr>
	
	<tr> <td colspan=10> <hr> </td> </tr>
	
	<tr class="lowfont">
		<td colspan=4> 1. Почтовый адрес для отправки ТТН:  </td>
		<td colspan=6> <b> 410064,г. Саратов, проспект Строителей, 60, </b> </td>
	</tr>
	
	<tr class="lowfont"> 
		<td colspan=10 id="tdleft"> В случае отправки документов по какому-либо иному адресу, оплата по рейсу производиться не будет. </td> 
	</tr>
	
	<tr class="lowfont">
		<td colspan=2> 2. Штрафные санкции: </td>
		<td colspan=8 id="tdleft"> за срыв загрузки штраф 20% от ставки за перевозку </td>
	</tr>
	
	<tr class="lowfont">
		<td id="tdright"> - <td>
		<td colspan=9> подача транспорта, непригодного для транспортировки груза приравнивается к срыву погрузки. </td>
	</tr>
	
	<tr class="lowfont">
		<td id="tdright"> - <td>
		<td colspan=9> оплата за простой транспортного средства под погрузкой/разгрузкой составляет 1000руб за каждые полные сутки, начиная со вторых суток, при наличии отметок о прибытии и убытии транспортного средства в ТТН, либо в ТрН, либо в путевом листе. </td>
	</tr>
	
	<tr class="lowfont">
		<td id="tdright"> - <td>
		<td colspan=9> за опоздание на погрузку/разгрузку 200 руб за каждый час </td>
	</tr class="lowfont">
	
	<tr class="lowfont">
		<td colspan=10> 3. Исполнитель (Перевозчик) несёт полную материальную ответственность за недостачу, утрату, порчу в процессе перевозки принятого к перевозке груза в полном объёме его стоимости в соответствии с законодательством РФ. Исполнитель ни при каких обстоятельствах не имеет право удерживать груз в обеспечение оплаты. В случае полной или частичной недостачи или повреждения груза, Исполнитель выплачивает Экспедитору полную стоимость поврежденного/недостающего груза. Экспедитор имеет право удержать стоимость поврежденного/недостающего груза из суммы за перевозку, указанную в настоящей Заявке. </td>
	</tr>
	
	<tr class="lowfont">
		<td colspan=10> 4. Категорически не допускается разгрузка из автомобиля Исполнителя в иной автомобиль, в том числе Грузополучателя. </td>
	</tr>
	
	<tr class="lowfont">
		<td colspan=10> 5. Категорически не допускается разгрузка автомобиля по адресу, не указанному в Заявке либо в ТТН. В том числе запрещается выгрузка на какие-либо склады временного хранения. В ином случае Исполнитель выплачивает Экспедитору штраф в размере не более полной стоимости груза и не менее стоимости перевозки, указанной в настоящей Заявке. </td>
	</tr>
	
	<tr class="lowfont">
		<td colspan=10> 6. По любым вопросам, связанным с погрузкой/разгрузкой, при нештатных ситуациях водитель обязан незамедлительно позвонить Заказчику по телефону 8-964-993-00-13 (круглосуточно). </td>
	</tr>
	
	<tr class="lowfont">
		<td colspan=10> 7. Оплата будет производиться только при наличии оригинала агентского договора от текущего года, счета, акта, счет-фактуры (в случае оплаты с НДС), реквизитов для оплаты, ТТН, ТрН, ТН и данной заявки с синими печатями. В счете и акте написать “Транспортно-экспедиционные услуги по маршруту” и указать маршрут, дату погрузки и фамилию водителя. Более ничего указывать не нужно. В счет-фактуре в пунктах 2, 2а, 3 и 4, а также в графах грузоотправитель и грузополучатель должны стоять прочерки, название организаций пишется либо в полном, либо в кратком формате, но не одновременно. В ином случае оплата задерживается, до получения оригиналов  документов, оформленных в соответствии с выше указанным требованием. Если реквизиты для оплаты не будут вложены в письмо, оплата за рейс продливается до 15 б/дн. Комиссии банка за перевод за счет получателя. </td>
	</tr>
	
	<tr class="lowfont">
		<td colspan=10> 8. Срок возврата ТТН 15 календарных дней с даты выгрузки. В случае задержки взимается штраф 5% от стоимости перевозки за каждые сутки просрочки, но не более суммы фрахта.  В случае утери или предоставления неполного комплекта документов Исполнителем либо его представителем, Исполнитель уплачивает штраф за восстановление документов Клиентом либо Экспедитором 5000рублей. </td>
	</tr>
	
	<tr class="lowfont">
		<td colspan=10> 9. В случае отсутствия связи с водителем более 3 часов, взимается штраф 2000рублей. </td>
	</tr>
	
	<tr class="lowfont">
		<td colspan=10> 10. Подтверждённая факсимильная Договор-заявка имеет юридическую силу и является подтверждением со стороны Исполнителя факта принятия Договор-заявки к исполнению. Приступив к исполнению данной заявки без формального подтверждения печатью Исполнитель выражает согласие на условия настоящей Договор-заявки. </td>
	</tr>
</table>

</div>
'); ?>
</body>
</html>