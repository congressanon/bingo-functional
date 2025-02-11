<?php

namespace Chemem\Bingo\Functional\Tests\Functional;

use Chemem\Bingo\Functional as f;

class SlugifyTest extends \PHPUnit\Framework\TestCase
{
  public function contextProvider()
  {
    return [
      ['lorem ipsum dolor', 'lorem-ipsum-dolor'],
      ['foo bar', 'foo-bar'],
      ['loki', 'loki'],
    ];
  }

  /**
   * @dataProvider contextProvider
   */
  public function testslugifyConvertsSpacesInStringToSlug($str, $res)
  {
    $slug = f\slugify($str);

    $this->assertEquals($res, $slug);
  }
}
