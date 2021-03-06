<?php

declare(strict_types=1);

namespace tebexio\pocketmine\api\listing;

use tebexio\pocketmine\api\TebexGETRequest;
use tebexio\pocketmine\api\TebexResponse;
use tebexio\pocketmine\api\RespondingTebexRequest;
use tebexio\pocketmine\api\utils\TebexGUIItem;

final class TebexListingRequest extends TebexGETRequest implements RespondingTebexRequest{

	public function getEndpoint() : string{
		return "/listing";
	}


	public function getExpectedResponseCode() : int{
		return 200;
	}

	public function createResponse(array $response) : TebexResponse{
		$categories = [];
		foreach($response["categories"] as $entry){
			$packages = [];
			foreach($entry["packages"] as $package){
				$packages[] = TebexPackage::fromTebexData($package);
			}

			$subcategories = [];
			foreach($entry["subcategories"] as $subcategory){
				$subcategory_packages = [];
				foreach($subcategory["packages"] as $package){
					$subcategory_packages[] = TebexPackage::fromTebexData($package);
				}

				$subcategories[] = new TebexSubCategory(
					$subcategory["id"],
					$subcategory["order"],
					$subcategory["name"],
					$subcategory_packages,
					new TebexGUIItem((string) $subcategory["gui_item"])
				);
			}

			$categories[] = new TebexCategory(
				$entry["id"],
				$entry["order"],
				$entry["name"],
				$packages,
				new TebexGUIItem((string) $entry["gui_item"]),
				$entry["only_subcategories"],
				$subcategories
			);
		}

		return new TebexListingInfo($categories);
	}
}