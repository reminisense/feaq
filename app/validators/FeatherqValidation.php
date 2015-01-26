<?php

class FeatherqValidation extends \Illuminate\Validation\Validator
{

    public function validateGreaterThanZero($attribute, $value, $parameters)
    {
        return $value > 0;
    }

    public function validateUniqueBranch($attribute, $value, $parameters)
    {
        return Branch::checkDuplicate($value, $this->getValue($parameters[0]), isset($parameters[1]) ? $this->getValue($parameters[1]) : 0) == 0;
    }

    public function validateOpenCloseTime($attribute, $value, $parameters)
    {
        $open_hour = $this->getValue($parameters[0]);
        $close_hour = $this->getValue($parameters[3]);
        if ($this->getValue($parameters[2]) == 'pm')
        {
            $open_hour = $this->getValue($parameters[0]) + 12;
        }
        if ($value == 'pm')
        {
            $close_hour = $this->getValue($parameters[3]) + 12;
        }
        if (mktime($open_hour, $this->getValue($parameters[1]), 0, date('m'), date('d'), date('Y')) >= mktime($close_hour, $this->getValue($parameters[4]), 0, date('m'), date('d'), date('Y')))
        {
            return FALSE;
        }
        return TRUE;
    }

    public function validateUniqueService($attribute, $value, $parameters)
    {
        return Service::checkDuplicate($value, $this->getValue($parameters[0]), $this->getValue($parameters[1]), isset($parameters[2]) ? $this->getValue($parameters[2]) : 0) == 0;
    }

    public function validateMinMaxQueue($attribute, $value, $parameters)
    {
        return $this->getValue($parameters[0]) < $value;
    }

    public function validateCorrectDateFormat($attribute, $value, $parameters)
    {
        $duplicate_dates = array();
        $date_regex = '/([1-9]|1[012])[- \/.]([1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/';
        $dates = explode(PHP_EOL, $value);
        foreach ($dates as $count => $single_date)
        {
            if (preg_match($date_regex, $single_date))
            {

                // check if there are duplicate dates
                if (in_array($single_date, $duplicate_dates))
                {
                    return FALSE;
                }
                $duplicate_dates[] = $single_date;

                try
                {
                    $date = new DateTime($single_date);
                    $format =  $date->format('m/d/Y');
                }
                catch (Exception $e)
                {
                    $format = FALSE;
                }
                if (!$format)
                {
                    return FALSE;
                }
            }
            else
            {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function validateBranchRestrictions($attribute, $value, $parameters)
    {
        if($value == 0)
        {
            return false;
        }
        if (Business::override($value))
        {
            $restrictions = BusinessRestrictions::getOverrideRestrictions($value);
        }
        else
        {
            $restrictions = Business::getRestrictions($value);
        }
        $branches = Business::getBranches($value);

        if (count($branches) < $restrictions->branch_limit)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function validateServiceRestrictions($attribute, $value, $parameters)
    {
        if ($value == 0)
        {
            return false;
        }

        if (Business::override($value))
        {
            $restrictions = BusinessRestrictions::getOverrideRestrictions($value);
        }
        else
        {
            $restrictions = Business::getRestrictions($value);
        }
        $services = Business::getServices($value);

        if (count($services) < $restrictions->service_limit)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function validateTerminalRestrictions($attribute, $value, $parameters)
    {
        if ($value == 0)
        {
            return false;
        }

        /*
         * $value here is branch ID so business ID must be fetched first using branch id
         * Non Property Object Fix 10222014
         * Create Terminal (MasterAdmin)
         */
        if (Business::override(Branch::businessId($value)))
        {
            $restrictions = BusinessRestrictions::getOverrideRestrictions(Branch::businessId($value));
        }
        else
        {
            $restrictions = Business::getRestrictions(Branch::businessId($value));
        }
        $branches = Business::getBranches(Branch::businessId($value));
        //########################################################################

        $terminalCount = 0;
        foreach ($branches as $branch)
        {
            $terminalCount += count(Terminal::getTerminalsByBranch($branch->branch_id));
        }

        if ($terminalCount < $restrictions->terminal_limit)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function validateUniqueTerminal($attribute, $value, $parameters)
    {
        return !Terminal::terminalNameExists($value, $this->getValue($parameters[1]), $this->getValue($parameters[0]), isset($parameters[2]) ? $this->getValue($parameters[2]) : NULL);
    }

    public function validateUserLimitReached($attribute, $value, $parameters)
    {
        $updatedUser = TRUE;
        if (isset($parameters[1]))
        {
            $updatedUser = Role::roleId($this->getValue($parameters[1])) != $this->getValue($parameters[0]);
        }
        if (!$value) return FALSE;
        $business_id = Branch::businessId($value);
        if (Business::override($business_id))
        {
            $restrictions = BusinessRestrictions::getOverrideRestrictions($business_id);
        }
        else
        {
            $restrictions = Business::getRestrictions($business_id);
        }
        $result = 0;
        switch ($this->getValue($parameters[0]))
        {
            case 6:
                $result = (count(Business::getItAdminsByBusiness($business_id)) >= $restrictions->it_admin_limit) && $updatedUser;
                break;
            case 3:
                $result = (count(Business::getBusinessEmployees($business_id, $this->getValue($parameters[0]))) >= $restrictions->queue_admin_limit) && $updatedUser;
                break;
            case 4:
                $result = (count(Business::getBusinessEmployees($business_id, $this->getValue($parameters[0]))) >= $restrictions->terminal_user_limit) && $updatedUser;
                break;
        }

        return !$result;
    }

    public function validateAllowRemote($attribute, $value, $parameters)
    {
        if(!$this->getValue($parameters[0])) return FALSE;
        if (Business::override($this->getValue($parameters[0])))
        {
            $bool = BusinessRestrictions::allowRemote($this->getValue($parameters[0]));
        }
        else
        {
            $bool = FeatherqSuit::allowRemote(Business::suitId($this->getValue($parameters[0])));
        }
        if (!$bool && $value)
        {
            return FALSE;
        }
        return TRUE;
    }

    public function validateRemoteQueueLimit($attribute, $value, $parameters)
    {
        if (Business::override($this->getValue($parameters[0])))
        {
            $bool = BusinessRestrictions::allowRemote($this->getValue($parameters[0]));
            $bool_1 = BusinessRestrictions::remoteQueueLimit($this->getValue($parameters[0]));
        }
        else
        {
            $bool = FeatherqSuit::allowRemote(Business::suitId($this->getValue($parameters[0])));
            $bool_1 = FeatherqSuit::remoteQueueLimit(Business::suitId($this->getValue($parameters[0])));
        }

        if ($bool == 1)
        {
            $userAllowRemote = $this->getValue($parameters[1]);
            if ($bool_1 < $value)
            { //checks if remote queue is greater than limit
                return FALSE;
            }
            if ($userAllowRemote == 1 && $value == 0)
            { //ARA 11042014 checks if there is a limit but when creating a service is unlimited
                return FALSE;
            }
        }

        return TRUE;
    }

    public function validateAllowAds($attribute, $value, $parameters)
    {
        if (!$value)
        { // Non Property Object fix
            return FALSE;
        }
        if (Business::override($value))
        {
            $bool = BusinessRestrictions::allowAds($value);
        }
        else
        {
            $bool = FeatherqSuit::allowAds(Business::suitId($value));
        }
        if (!$bool)
        {
            return FALSE;
        }
        return TRUE;
    }

    public function validateNumAdsPerBusiness($attribute, $value, $parameters)
    {
        if (!$value)
        { // Non Property Object fix
            return FALSE;
        }
        if (Business::override($value))
        {
            $bool = BusinessRestrictions::adsLimit($value);
        }
        else
        {
            $bool = FeatherqSuit::adsLimit(Business::suitId($value));
        }

        $count = count(Advertisement::fetchAdvertisementsByBusinessId($value));
        if ($count >= $bool)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function validateNumAdsPerBranch($attribute, $value, $parameters)
    {
        $count = count(Advertisement::fetchAdvertisesByBranchId($value));

        if ($count >= 1)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function validateAlphaSpaces($attribute, $value, $parameters)
    {
        return preg_match('/^[\pL\s]+$/u', $value);
    }

    public function validateCustomUnique($attributes, $value, $parameters)
    {
        $user = User::select('username', 'email', 'phone')->where('user_id', '=', $parameters[2])->get()->first();
        switch($parameters[1])
        {
            case 'username':
                if ($user->username == $value)
                {
                    return TRUE;
                }
                else
                {
                    $user = User::select('username')->where('username', '=', $value)->where('user_id', '!=', $parameters[2])->get()->first();
                    if ($user == NULL)
                    {
                        return TRUE;
                    }
                    else
                    {
                        return FALSE;
                    }
                }
                break;
            case 'phone':
                if ($user->phone == $value || $value == '' || $value == '0')
                {
                    return TRUE;
                }
                else
                {
                    $user = User::select('phone')->where('phone', '=', $value)->where('user_id', '!=', $parameters[2])->get()->first();
                    if ($user == NULL){
                        return TRUE;
                    } else {
                        return FALSE;
                    }
                }
                break;
            case 'email':
                if ($user->email == $value || $value == '')
                {
                    return TRUE;
                }
                else
                {
                    $user = User::select('email')->where('email', '=', $value)->where('user_id', '!=', $parameters[2])->get()->first();
                    if ($user == NULL)
                    {
                        return TRUE;
                    }
                    else
                    {
                        return FALSE;
                    }
                }
                break;
        }
    }

}