<?php


namespace AppBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\SoftMain;
use Symfony\Component\Yaml\Yaml;




class AwesomeSearch
{

    const BOOLPOINT = 1;
    const TAGPOINT = 2;
    const CONTENTPOINT = 3;
    const NAMEPOINT = 5;

    /** @var ObjectManager */
    private $em;

    /**
     * @var mixed
     */
    private $datas;

    /**
     * @var array
     */
    private $finalResult;


    /**
     * AwesomeSearch constructor.
     * @param EntityManagerInterface $em
     * @param $rootDir
     */
    public function __construct(EntityManagerInterface $em, $rootDir)
    {
        $this->em = $em;
        $this->finalResult = array();
        $this->datas = Yaml::parse(file_get_contents($rootDir . "/config/awesomeSearch.yml"));

    }


    /**
     * Receive the exact query ask by user, give a array of ordered softwares, ready to display
     * @param string $query
     * @return array
     */

    public function search(string $query = "")
    {


        // Clean query with method : delete stop and little words
        $words = $this->cleanQuery($query);


        // foreach words, look if it's in title, or description, or bool
        foreach ($words as $word) {

            $softmainNameResults = $this->em->getRepository(SoftMain::class)->searchInSoftmainName($word);
            $this->addPertinencePoint($softmainNameResults, self::NAMEPOINT);

            $softmainDescriptionResults = $this->em->getRepository(SoftMain::class)->searchInSoftmainDescription($word);
            $this->addPertinencePoint($softmainDescriptionResults, self::CONTENTPOINT);


            $commentResults = $this->em->getRepository(SoftMain::class)->searchInComment($word);
            $this->addPertinencePoint($commentResults, self::CONTENTPOINT);


            $advantagesResults = $this->em->getRepository(SoftMain::class)->searchInAdvantages($word);
            $this->addPertinencePoint($advantagesResults, self::CONTENTPOINT);


            $drawbacksResults = $this->em->getRepository(SoftMain::class)->searchInDrawbacks($word);
            $this->addPertinencePoint($drawbacksResults, self::CONTENTPOINT);


            $typeResults = $this->em->getRepository(SoftMain::class)->searchInType($word);
            $this->addPertinencePoint($typeResults, self::CONTENTPOINT);


            $customersResults = $this->em->getRepository(SoftMain::class)->searchInCustomers($word);
            $this->addPertinencePoint($customersResults, self::CONTENTPOINT);


            $hostingCountryResults = $this->em->getRepository(SoftMain::class)->searchInHostingCountry($word);
            $this->addPertinencePoint($hostingCountryResults, self::CONTENTPOINT);


            $creationDateResults = $this->em->getRepository(SoftMain::class)->searchInCreationDate($word);
            $this->addPertinencePoint($creationDateResults, self::CONTENTPOINT);

            $webSiteResults = $this->em->getRepository(SoftMain::class)->searchInWebSite($word);
            $this->addPertinencePoint($webSiteResults, self::CONTENTPOINT);

            $knowledgeBaseLanguageResults = $this->em->getRepository(SoftMain::class)->searchInKnowledgeBaseLanguage($word);
            $this->addPertinencePoint($knowledgeBaseLanguageResults, self::CONTENTPOINT);


            $tagNameResults = $this->em->getRepository(SoftMain::class)->searchInTagName($word);
            $this->addPertinencePoint($tagNameResults, self::TAGPOINT);


            $tagDescriptionResults = $this->em->getRepository(SoftMain::class)->searchInTagDescription($word);
            $this->addPertinencePoint($tagDescriptionResults, self::TAGPOINT);

            $this->rateByBool($word);

        }

        $arrayToSort = $this->getFinalResult();

        foreach ($arrayToSort as $key => $row) {
            $point2[$key] = $row['points'];
        }
        if (!empty($arrayToSort)) {
            array_multisort($point2, SORT_DESC, $arrayToSort);
        }
        $result = [];

        foreach ( $arrayToSort as $cell ) {
            $result[]  = $cell['soft'];
        }

        $response = [];
        foreach($result as $software) {
            $response[] = array(
                'name' => $software->getName(),
                'slug' => $software->getSlug(),
                'description' => mb_strimwidth($software->getDescription(), 0, 160),
                'logo' => $software->getLogoUrl(),
                'isRgpd' => $software->getSoftInfo()->getRgpd(),
                'isSms' => $software->getSoftOutBound()->getIsSms(),
                'isEmail' => $software->getSoftOutBound()->getIsEmail(),
                'isPopin' => $software->getSoftOutBound()->getIsPopin(),
                'isMailPostal' => $software->getSoftOutBound()->getIsMailPostal(),
                'isCallCenter' => $software->getSoftOutBound()->getIsCallCenter(),
                'isPushMobile' => $software->getSoftOutBound()->getIsPushMobile(),
                'isApi' => $software->getSoftOutBound()->getIsApi(),
                'isActivityReportCreation' => $software->getSoftReport()->getIsActivityReportCreation(),
                'isActivityReportPeriodicSend' => $software->getSoftReport()->getIsActivityReportPeriodicSend(),
                'isSegmentCreation' => $software->getSoftSegmentOperation()->getIsSegmentCreation(),
                'isTwitterMonitoring' => $software->getSoftSocialMedia()->getIsTwitterMonitoring(),
                'isTwitterAutoPublication' => $software->getSoftSocialMedia()->getIsTwitterAutoPublication(),
                'isLinkedinMonitoring' => $software->getSoftSocialMedia()->getIsLinkedinMonitoring(),
                'isLinkedinAutoPublication' => $software->getSoftSocialMedia()->getIsLinkedinAutoPublication(),
                'isInstagramAutoPublication' => $software->getSoftSocialMedia()->getIsInstagramAutoPublication(),
                'isInstagramMonitoring' => $software->getSoftSocialMedia()->getIsInstagramMonitoring(),
                'isEmailSupport' => $software->getSoftSupport()->getIsEmailSupport(),
                'isPhoneSupport' => $software->getSoftSupport()->getIsPhoneSupport(),
                'isChatSupport' => $software->getSoftSupport()->getIsChatSupport(),
                'isKnowledgeBase' => $software->getSoftSupport()->getIsKnowledgeBase(),
                'isTechnicalDocument' => $software->getSoftSupport()->getIsTechnicalDocument(),
                'isContactObject' => $software->getSoftLeadsOperation()->getIsContactObject(),
                'isCompanyObject' => $software->getSoftLeadsOperation()->getIsCompanyObject(),
                'isDefinedFields' => $software->getSoftLeadsOperation()->getIsDefinedFields(),
                'isIllimitedFields' => $software->getSoftLeadsOperation()->getIsIllimitedFields(),
                'isImportCsv' => $software->getSoftLeadsOperation()->getIsImportCsv(),
                'isAutoDuplicate' => $software->getSoftLeadsOperation()->getIsAutoDuplicate(),
                'isLeadStages' => $software->getSoftLeadsOperation()->getIsLeadStages(),
                'isLandingPage' => $software->getSoftCommSupport()->getIsLandingPage(),
                'isForm' => $software->getSoftCommSupport()->getIsForm(),
                'isTracking' => $software->getSoftCommSupport()->getIsTracking(),
                'isLiveChat' => $software->getSoftCommSupport()->getIsLiveChat(),
            );
        }
        return $response;
    }

    /**
     *
     * @param string $query
     * @return array
     * Receive the exact query ask by user, give a clean array of words to explore whithout stop words and other stuffs
     *
     */

    private function cleanQuery(string $query) :array
    {

        $arrayOfWords = preg_split("/[\s,+\"'&%().]+/", $query);
        $goodQuery = [];
        $emptyWords = $this->getDatas()["EmptyWords"];
        $arrayEmptyWords = explode(" ", $emptyWords);

        foreach ($arrayOfWords as $word) {
            $isDirtyOrNot = in_array($word, $arrayEmptyWords);
            if ($isDirtyOrNot === false AND strlen($word) > 2) {
                $goodQuery[] .= $word;
            }
        }

        return $goodQuery;
    }


    /**
     * @param string $word
     * @return array
     *
     * This method look in data where is the synonym of a given word
     * When match with any entities and booleans, it get an array of SoftMains where boolean is true.
     * this array of SoftMains is rated by other method, and finally it merged in class property finalResult.
     *
     */

    public function rateByBool(string $word)
    {


        $resultTable = [];
        $j = 0;
        $entityKeys = array_keys($this->getDatas()['Booleans']);

        foreach ( $this->getDatas()['Booleans'] as $table ) {
            $i = 0;
            $booleanKeys = array_keys($table);
            foreach ( $table as $val ) {
                $synonymous = $val["Synonymous"] ;
                if ( stristr($synonymous, $word) != FALSE ) {
                    $resultTable = $this->em->getRepository(SoftMain::class)->getSoftByAnyBool($booleanKeys[$i], $entityKeys[$j]);
                    //Version finale: ajouter cette methode pour ajouter chaque resultat à la proprieté finale
                    $this->addPertinencePoint($resultTable, self::BOOLPOINT);
                }
                $i++;
            }
            $j++;
        }
        // TODO : Cette function DOIT return uniquement true, mais elle ajoute à final result tous les tableaux trouvés par la query. À LA VERSION FINAL: remplacer par return true

        return $resultTable;
    }

    /**
     * @param array $array
     * @return bool
     *
     * cette fonction prend en argument un array et parcourt le resultFinal, lajoute chaque ligne de l'array si elle n'existe pas ou alors ajoute à l'id deja existant
     *
     */
    public function addToFinalResult(array $array)
    {
        $j = 0;
        foreach ($array as $result) {
            $i = 0;
            $myTestProperty = $this->getFinalResult();
            if( $myTestProperty != null) {
                foreach ($myTestProperty as $resultFinalLign) {
                    if ($result['soft'] === $resultFinalLign['soft']) {
                        $this->finalResult[$i]['points'] += $result['points'];
                        $result['points'] = 0;
                    }
                    $i++;
                }
                if ($result['points'] != 0) {
                    array_push($this->finalResult, $result);
                }
            } else {
                array_push($this->finalResult, $result);
            }
            $j++;
        }
        return true;
    }

    /**
     * @return EntityManagerInterface
     */

    public function getEm()
    {
        return $this->em;
    }

    /**
     * @return mixed
     */
    public function getDatas()
    {
        return $this->datas;
    }
    /**
     * @return array
     */
    public function getFinalResult()
    {
        return $this->finalResult;
    }

    /**
     * @param array $results
     * @param $pertinencePoint
     * @return array
     */
    public function addPertinencePoint(array $results, $pertinencePoint)
    {
        $resultsPoint = [];

        for ($i = 0; $i < count($results); $i++) {

            $soft = array('soft' => $results[$i]);
            $point = array('points' => $pertinencePoint);

            $resultsPoint[] = $soft + $point;
            //Version finale: ajouter cette methode pour ajouter chaque resultat à la proprieté finale
        }
        $this->addToFinalResult($resultsPoint);

        return $resultsPoint;

    }


}