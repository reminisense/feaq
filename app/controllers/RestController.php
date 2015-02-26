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

        return Response::json($popular_business, 200, array(), JSON_PRETTY_PRINT);
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
        return Response::json($found_business, 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * @author Ruffy
     * @param $id BusinessI ID of the selected business
     * @return JSON object generated through businessId according to the database
     */
    public function getBusinessDetail($id) {
        $search = Business::find($id);
        return Response::json($search, 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * @author Ruffy
     * @return JSON response containing list of active businesses
     */
    public function getActiveBusiness() {
        $active_businesses = array();
        $businesses = Business::all();
        foreach ($businesses as $count => $business) {
            $branches = Branch::getBranchesByBusinessId($business->business_id);
            foreach ($branches as $count2 => $branch) {
                $services = Service::getServicesByBranchId($branch->branch_id);
                foreach ($services as $count3 => $service) {
                    $priority_numbers = PriorityNumber::getTrackIdByServiceId($service->service_id);
                    foreach ($priority_numbers as $count4 => $priority_number) {
                        $priority_queues = PriorityQueue::getTransactionNumberByTrackId($priority_number->track_id);
                        foreach ($priority_queues as $count5 => $priority_queue) {
                            $terminal_transactions = TerminalTransaction::getTimesByTransactionNumber($priority_queue->transaction_number);
                            foreach ($terminal_transactions as $count6 => $terminal_transaction) {
                                $grace_period = time() - $terminal_transaction->time_queued; // issued time must be on the current day to count as active
                                if ($terminal_transaction->time_queued != 0
                                    && $terminal_transaction->time_completed == 0
                                    && $terminal_transaction->time_removed == 0
                                    && $grace_period < 86400 ) { // 1 day; 60secs * 60 min * 24 hours
                                    $active_businesses[] = array(
                                        'business_id' => $business->business_id,
                                        'local_address' => $business->local_address,
                                        'name' => $business->name,
                                    );
                                    $actives = array('active-business' => $active_businesses);
                                    break;
                                }
                            }
                            if (array_key_exists($business->business_id, $active_businesses)) {
                                break;
                            }
                        }
                        if (array_key_exists($business->business_id, $active_businesses)) {
                            break;
                        }
                    }
                    if (array_key_exists($business->business_id, $active_businesses)) {
                        break;
                    }
                }
                if (array_key_exists($business->business_id, $active_businesses)) {
                    break;
                }
            }
        }
        return Response::json($actives, 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * @author Ruffy
     * @param int $business_id
     * @return Formatted single JSON Object that contains all attributes related to the Broadcast Page numbers
     */
    public function getShowNumber($business_id = 0) {
        $numbers = json_decode(file_get_contents(public_path() . '/json/' . $business_id . '.json'), true);
        $output = array();

        $get_num = $numbers['get_num'];
        $display = $numbers['display'];
        $date = $numbers['date'];

        unset($numbers['get_num']);
        unset($numbers['display']);
        unset($numbers['date']);

        foreach($numbers as $key => $box_data) {
            // generate object attribute
            $title = $key;
            foreach($box_data as $key2 => $box_details) {
                $title = $title . $key2;
                $output[$title] = $numbers[$key][$key2];
            }
        }
        $output['get_num'] = $get_num;
        $output['display'] = $display;
        $output['date'] = $date;

        return Response::json($output, 200, array(), JSON_PRETTY_PRINT);
    }

}