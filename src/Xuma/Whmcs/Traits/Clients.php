<?php namespace Xuma\Whmcs\Traits;

trait Clients {
    /**
     * Get all clients.
     *
     * @param array|null $params
     * @return mixed
     */
    public function getClients($params=[])
    {
        $response= $this->getJson('getclients',$params);

        return $response->clients->client;
    }

    /**
     * Getting clients details.
     *
     * @param $identity
     * @param array $params
     * @return mixed
     */
    public function getClientsDetails($identity,$params=[])
    {
        is_int($identity) ? ($params['clientid']=$identity) : ($params['email']=$identity);

        $response= $this->getJson('getclientsdetails',$params);

        return $response;
    }

    /**
     * Getting clients products.
     *
     * @param $id
     * @return bool
     */
    public function getClientsProducts($id)
    {
        $params['clientid']=$id;
        // TODO not working.
        $response= $this->getJson('getclientsproducts',$params);

        return ($response->totalresults>0) ? $response->products->product :false;
    }

    /**
     * Get clients domains.
     *
     * @param $id
     * @param array $params
     * @return bool
     */
    public function getClientsDomains($id,$params=[])
    {
        $params['clientid']=$id;

        $response= $this->getJson('getclientsdomains',$params);

        return ($response->totalresults>0) ? $response->domains->domain :false;
    }

    /**
     * Get clients password.
     *
     * @param $identity
     * @param array $params
     * @return mixed
     */
    public function getClientsPassword($identity,$params=[])
    {
        is_int($identity) ? ($params['userid']=$identity) : ($params['email']=$identity);

        $response= $this->getJson('getclientpassword',$params);

        return $response ? $response->password :false;
    }


    /**
     * Get clients all tickets.
     * @param $identity
     * @param array $params
     * @return bool
     */
    public function getClientsTickets($identity,$params=[])
    {
        is_int($identity) ? ($params['clientid']=$identity) : ($params['email']=$identity);

        $response= $this->getJson('gettickets',$params);

        return $response->numreturned>0 ? $response->tickets->ticket : false;
    }

    /**
     * Get clients single ticket.
     * @param $ticketid
     * @return bool
     */
    public function getClientsTicket($ticketid)
    {
        $params['ticketid']=$ticketid;

        $response= $this->getJson('getticket',$params);

        return $response;
    }

    /**
     * @param $email
     * @param $password
     * @return mixed
     */
    public function ValidateLogin($email,$password)
    {
        $params['email'] = $email;
        $params['password2'] = $password;

        $response= $this->getJson('validatelogin',$params);

        return $response;
    }

    /*
     *  $postfields["action"] = "addclient";
 $postfields["firstname"] = "Test";
 $postfields["lastname"] = "User";
 $postfields["companyname"] = "WHMCS";
 $postfields["email"] = "demo@whmcs.com";
 $postfields["address1"] = "123 Demo Street";
 $postfields["city"] = "Demo";
 $postfields["state"] = "Florida";
 $postfields["postcode"] = "AB123";
 $postfields["country"] = "US";
 $postfields["phonenumber"] = "123456789";
 $postfields["password2"] = "demo";
 $postfields["customfields"] = base64_encode(serialize(array("1"=>"Google")));
 $postfields["currency"] = "1";
     */


    public function AddClient($firstname = '',$lastname = '',$companyname = '',$email,$password)
    {
        $params['email']            = $email;
        $params['firstname']        = $firstname;
        $params['lastname']         = $lastname;
        $params['companyname']      = $companyname;
        $params['password2']        = $password;

        $response= $this->getJson('addclient',$params);

        return $response;
    }



    public function decrypt($hash)
    {
        $params['password2'] = $hash;

        $response = $this->getJson('decryptpassword',$params);

        return $response->password;
    }
}
