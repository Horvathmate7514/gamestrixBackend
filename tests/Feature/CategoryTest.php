<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/api/product/101');

        $response->assertSimilarJson(["ProductNumber" => 101,
        "ProductName" => "Intel i5-12500 6-Core 3.00GHz LGA1700 Processzor",
        "ProductDescription" => "A 12. generációs Intel® Core™ asztali processzor újradefiniálja az x86 architektúra teljesítményét. Bemutatjuk új hibrid teljesítményű architektúránkat, amely a játék, a termelékenység és a \r\n<br>\r\nkreativitás fokozása érdekében egyesíti a teljesítménymagokat a hatékony magokkal. Ezek a forradalmi processzorok intelligensen optimalizálják a munkaterhelést, és megnyitják az utat a processzortervezés jövőbeli ugrásai előtt. Élvezze a legújabb platform-innovációk teljes skáláját, például az iparágban elsőként elérhető PCIe 5.0 és a DDR5 memória. Az Intel® UHD grafikus processzorral merüljön el a lenyűgöző vizuális élményben az akár 8K HDR-támogatással és a 4 4K kijelző egyidejű megtekintésének lehetőségével. A 12. generációs Intel® Core™ asztali processzorok minden olyan funkciót biztosítanak, amelyre a játékhoz, munkához és alkotáshoz szüksége van, mint még soha.\r\n",
        "RetailPrice" => 115245,
        "QuantityOnHand" => 100,
        "CategoryID" => 1,
        "Image" => "https://horvathmate.sirv.com/i5.webp"]);
    }
}
