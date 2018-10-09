<?php

namespace app\models;

use Yii;
use yii\base\Component;
use garyrutland\facebook\Facebook;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Exception;
/**
 * This is the model class for table "facebook".
 *
 * @property int $no
 * @property string $id
 * @property string $name
 * @property string $screenName
 */
class Facebook extends Component
{
    public $appId;
    public $secret;
    public $scope;
    private $session;
    private $accessToken;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facebook';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no', 'id', 'name', 'screenName'], 'required'],
            [['no'], 'integer'],
            [['id', 'name', 'screenName'], 'string', 'max' => 255],
            [['no'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no' => 'No',
            'id' => 'ID',
            'name' => 'Name',
            'screenName' => 'Screen Name',
        ];
    }

    public function init()
    {
        parent::init();
        if (!Yii::$app->session->isActive) {
            Yii::$app->session->open();
        }
        FacebookSession::setDefaultApplication($this->appId, $this->secret);
        $accessToken = Yii::$app->session->get('fbAccessToken');
        if ($accessToken !== null) {
            $this->setSession(new FacebookSession($accessToken));
        }
    }
    public function getSession()
    {
        return $this->session;
    }
    public function setSession(FacebookSession  $session)
    {
        $this->setAccessToken($session->getToken());
        $this->session = $session;
    }
    public function getAccessToken()
    {
        return $this->accessToken;
    }
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        Yii::$app->session->set('fbAccesstoken', $this->accessToken);
    }
    public function getLoginUrl($redirectUrl, $scope = null)
    {
        $helper = new FacebookRedirectLoginHelper($redirectUrl);
        return $helper->getLoginUrl(['scope' => $scope]);
    }
    public function getLoginSession($redirectUrl)
    {
        $helper = new FacebookRedirectLoginHelper($redirectUrl);
        $this->setSession($helper->getSessionFromRedirect());
        return $this->getSession();
    }
    public function getUser($userId = 'me')
    {
        try {
            $request = new FacebookRequest($this->getSession(), 'GET', '/' . $userId);
            return $request->execute()->getGraphObject(GraphUser::className())->asArray();
        } catch (Exception $e) {}
        return [];
    }
    public function getFriends($userId = 'me')
    {
        $limit = 25;
        $friendCount = $this->getFriendsCount($userId);
        $friends = [];
        try {
            for ($offset = 0; $offset <= $friendCount; $offset += $limit) {
                $request = new FacebookRequest($this->getSession(), 'GET', '/' . $userId . '/friends', [
                    'offset' => $offset,
                    'limit' => $limit,
                ]);
                $response = $request->execute()->getGraphObject()->asArray();
                foreach ($response['data'] as $friend) {
                    array_push($friends, (array) $friend);
                }
                if (count($friends) < $limit) {
                    break;
                }
            }
        } catch (Exception $e) {}
        return $friends;
    }
    public function getFriendsCount($userId = 'me')
    {
        try {
            $request = new FacebookRequest($this->getSession(), 'GET', '/' . $userId . '/friends', [
                'offset' => 0,
                'limit' => 0,
            ]);
            $response = $request->execute()->getGraphObject()->asArray();
            return $response['summary']->total_count;
        } catch (Exception $e) {}
        return 0;
    }
}
