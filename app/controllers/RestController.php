<?php
/**
 * Created by IntelliJ IDEA.
 * User: RUFFY
 * Date: 2/25/2015
 * Time: 10:29 AM
 */

class RestController extends BaseController {

    /**
     * @author Ruffy
     * @param null $quantity when User wants to specify how many to return
     * @return JSON response containing Business objects with: business_id, name, local_address
     */
    public function getPopularBusiness($quantity = null) {

        $businesses = DB::table('business')
            ->select(array('business_id', 'name', 'local_address'))
            ->take($quantity == null ? 5 : $quantity)
            ->get();

        $popular_business = array('popular-business' => $businesses);

        return Response::json($popular_business);

    }

    /**
     * @author Ruffy
     * @param $query Query string input for searching for a business
     * @return JSON response containing businesses that qualified with the search query
     */
    public function getSearchBusiness($query) {
        $search_results = DB::table('business')
            ->where('name', 'LIKE', '%' . $query . '%')
            ->select(array('business_id', 'name', 'local_address'))
            ->get();

        $found_business = array('search-result' => $search_results);
        return Response::json($found_business);
    }

}