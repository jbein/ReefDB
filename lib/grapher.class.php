<?php

error_reporting(E_ALL);

class Grapher {
	protected $config = null;
	protected $hostname = null;
    protected $username = null;
    protected $password = null;
    protected $protocol = "https";
    protected $height = 300;
    protected $width  = 700;
    protected $dashboard = null;
    protected $dashboardStore = "db";
	protected $panelID = null;
    protected $customVars = null;

    public function __construct($_config) {
	    $this->config 		= $_config;
		$this->hostname  	= $this->config['hostname'];
		$this->username  	= $this->config['username'];
		$this->password  	= $this->config['password'];
		$this->dashboard 	= $this->config['dashboard'];
		$this->panelID		= $this->config['panelID'];
	}

    public function getGraphAsImage($_tankName, $_id) {
        $this->customVars .= "&var-tankName=".$_tankName."&var-field=".$_id;
        $pngURL = sprintf(
        	'%s://%s/render/dashboard-solo/%s/%s?panelId=%s&width=%s&height=%s&theme=light%s',
            $this->protocol,
            $this->hostname,
            $this->dashboardStore,
            $this->dashboard,
            $this->panelID,
            $this->width,
            $this->height,
            $this->customVars
        );

        $curl_handle = curl_init();
        $curl_opts = array(
            CURLOPT_URL => $pngURL,
            CURLOPT_CONNECTTIMEOUT => 2,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_USERPWD => $this->username.":".$this->password,
            CURLOPT_HTTPAUTH, CURLAUTH_ANY
        );
		
        curl_setopt_array($curl_handle, $curl_opts);

        $res = curl_exec($curl_handle);

        if($res === false) {
            return "<b>Graph currently unavailable: Curl error: ' ".curl_error($curl_handle)." '</b>";
        }

        $statusCode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);

        if($statusCode > 299) {
            $error = @json_decode($res);
            return "<b>Cannot fetch Grafana graph: ". Util::httpStatusCodeToString($statusCode) .
                   " ($statusCode)</b>: " . (property_exists($error, 'message') ? $error->message : "");
        }

        curl_close($curl_handle);

        $img = 'data:image/png;base64,'.base64_encode($res);
        $imghtml = '<img src="%s" alt="%s" width="%d" height="%d" />';
        return sprintf(
            $imghtml,
            $img,
            rawurlencode($_id),
            $this->width,
            $this->height
        );
    }
}

?>
