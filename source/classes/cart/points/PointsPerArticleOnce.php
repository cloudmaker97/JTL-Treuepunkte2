<?php
namespace Plugin\dh_bonuspunkte\source\classes\cart\points;

use JTL\Cart\CartItem;
use Plugin\dh_bonuspunkte\source\interfaces\points\IPoint;

/**
 * This points class is used to calculate the points based on the functional attribute "bonuspunkte_pro_artikel_einmal"
 * Example: Article A is set to 2 points, there are 3 of them in the cart, the result is 2 points.
 * Each article gives the same amount of points once per article, set in the functional attribute.
 */
class PointsPerArticleOnce implements IPoint {
	/**
	 * @var int $defaultPoints The default amount of points if the functional attribute is not set
	 */
	private int $defaultPoints = 0;

	/**
	 * With this method you can set the default amount of points if the functional attribute is not set
	 */
	public function setDefaultPoints(int $defaultPoints): void
	{
		$this->defaultPoints = $defaultPoints;
	}

    /**
	 * @inheritDoc
	 */
	public static function getName(): string {
        return "Bonuspunkte pro Artikel (Einmal)";
	}
	
    /**
	 * @inheritDoc
	 */
	public static function getFunctionAttributName(): string {
        return "bonuspunkte_pro_artikel_einmal";
	}
	
    /**
	 * @inheritDoc
	 */
	public function getPointAmount($data): int {
		if(isset($data->Artikel->FunktionsAttribute[self::getFunctionAttributName()])) {
			return (int)$data->Artikel->FunktionsAttribute[self::getFunctionAttributName()];
		} else {
			return $this->defaultPoints;
		}
	}
}