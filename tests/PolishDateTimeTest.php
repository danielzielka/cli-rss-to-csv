<?php declare(strict_types=1);
namespace DanielZielkaRekrutacjaHRtec\tests\PolishDateTime;

use PHPUnit\Framework\TestCase;
use DanielZielkaRekrutacjaHRtec\helpers\PolishDateTime;


class PolishDateTimeTest extends TestCase
{
    public function testPolishDateMonthTranslation()
    {
        $model = new PolishDateTime('2019-01-01 08:10:10');
        $this->assertEquals($model->format('d M Y H:i:s'), '01 Styczeń 2019 08:10:10');

        $model = new PolishDateTime('2019-02-01 08:10:10');
        $this->assertEquals($model->format('d M Y H:i:s'), '01 Luty 2019 08:10:10');

        $model = new PolishDateTime('2019-03-01 08:10:10');
        $this->assertEquals($model->format('d M Y H:i:s'), '01 Marzec 2019 08:10:10');

        $model = new PolishDateTime('2019-04-01 08:10:10');
        $this->assertEquals($model->format('d M Y H:i:s'), '01 Kwiecień 2019 08:10:10');

        $model = new PolishDateTime('2019-05-01 08:10:10');
        $this->assertEquals($model->format('d M Y H:i:s'), '01 Maj 2019 08:10:10');

        $model = new PolishDateTime('2019-06-01 08:10:10');
        $this->assertEquals($model->format('d M Y H:i:s'), '01 Czerwiec 2019 08:10:10');

        $model = new PolishDateTime('2019-07-01 08:10:10');
        $this->assertEquals($model->format('d M Y H:i:s'), '01 Lipiec 2019 08:10:10');

        $model = new PolishDateTime('2019-08-01 08:10:10');
        $this->assertEquals($model->format('d M Y H:i:s'), '01 Sierpień 2019 08:10:10');

        $model = new PolishDateTime('2019-09-01 08:10:10');
        $this->assertEquals($model->format('d M Y H:i:s'), '01 Wrzesień 2019 08:10:10');

        $model = new PolishDateTime('2019-10-01 08:10:10');
        $this->assertEquals($model->format('d M Y H:i:s'), '01 Październik 2019 08:10:10');

        $model = new PolishDateTime('2019-11-01 08:10:10');
        $this->assertEquals($model->format('d M Y H:i:s'), '01 Listopad 2019 08:10:10');

        $model = new PolishDateTime('2019-12-01 08:10:10');
        $this->assertEquals($model->format('d M Y H:i:s'), '01 Grudzień 2019 08:10:10');
    }
}
