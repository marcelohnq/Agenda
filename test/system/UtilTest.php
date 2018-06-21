<?php
use PHPUnit\Framework\TestCase;

class UtilTest extends TestCase
{
    public function testExtensionFile()
    {
        $cpf = "12312312312";
        $extension = pathinfo("/var/www/alt.php", PATHINFO_EXTENSION);
        $nameFile = "{$cpf}.{$extension}";

        $this->assertEquals("12312312312.jpg", $nameFile);
    }

	/**
     * @dataProvider phoneProviderTrue
     */
	public function testFormatPhoneTrue($phone)
	{
		$this->expectOutputRegex('/\(..\).?....-..../');
		print Util::formatPhone($phone);
	}

	/**
     * @dataProvider cpfProviderTrue
     */
	public function testFormatCPFTrue($cpf)
	{
		$this->expectOutputRegex('/...\....\....-../');
		print Util::formatCPF($cpf);
	}	

	/**
     * @dataProvider phoneProviderFalse
     */
	public function testFormatPhoneFalse($phone)
	{
		$this->assertFalse(Util::formatPhone($phone));
	}

	/**
     * @dataProvider cpfProviderFalse
     */
	public function testFormatCPFFalse($cpf)
	{
		$this->assertFalse(Util::formatCPF($cpf));
	}

    public function phoneProviderTrue()
    {
        return [
            ["6781267054"], //true
            ["67981267054"] //true
        ];
    }

    public function cpfProviderTrue()
    {
        return [
            ["40812132831"] //true
        ];
    }

    public function phoneProviderFalse()
    {
        return [
            ["67"], //false
            ["(67)98126-7054"], //false
            ["(6781267054"], // false
            ["67812670546781267054"], //false
        ];
    }

    public function cpfProviderFalse()
    {
        return [
            ["408"], //false
            ["408.121.328-31"], //false
            ["4081213283140812132831"], // false
        ];
    }
}