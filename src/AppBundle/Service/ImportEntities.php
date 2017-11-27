<?php

namespace AppBundle\Service;

use AppBundle\Entity\SoftCommSupport;
use AppBundle\Entity\SoftInfo;
use AppBundle\Entity\SoftLeadsOperation;
use AppBundle\Entity\SoftMain;
use AppBundle\Entity\SoftMarketingCampaign;
use AppBundle\Entity\SoftOtherFunctionnalities;
use AppBundle\Entity\SoftOutbound;
use AppBundle\Entity\SoftReport;
use AppBundle\Entity\SoftSegmentOperation;
use AppBundle\Entity\SoftSocialMedia;
use AppBundle\Entity\SoftSupport;
use AppBundle\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;

class ImportEntities
{
// Première version : on hydrate nos objets manuellement
// Voir une v2 où on pourrait créer les entités à la volée, ce qui permettrait une meilleure maintenance du système et la possibilité de maintenir la base (MAJ des colonnes, par exemple)

    /** @var ObjectManager */
    private $em;
    private $slugificator;
    private $errors;

    public function __construct(ObjectManager $em, Slugification $slugificator)
    {
        $this->slugificator = $slugificator;
        $this->em = $em;
        $this->errors = array();
        /*
                // D'abord on vérifie si ce qu'on reçoit est bien un fichier lisible, si c'est pas le cas, on envoie une exception
                if(!file_exists($fileFromConsole)) {
                    //TODO : améliorer ce truc
                    throw new \Exception("Ce n'est pas un fichier");
                }else{



                }
                 */
    }

    private function checkIfString()
    {
        //Check if data is string, if it's not, return error
        // But I don't know if it's really efficient (utf8?)
        // Vérifier que le texte n'est pas "oui" ou "non"
    }

    private function checkIfInteger($value, $column)
    {
        if (is_int($value) === FALSE) {
            array_push($this->errors, "Column" . $column . ": " . $value . "is expected to be an integer");
        }
    }

    //si c'est différent de oui ou non, mais que c'est quand meme set ->error)
    private function checkIfBool($value, $column)
    {
        if ($value != "oui" || $value != "non") {
            if (isset($value)) {
                array_push($this->errors, "Column" . $column . ": " . $value . "is expected to be a boolean");
            }
        }

    }

// conversion des "oui" ou "non" ou "" par les booleens correspondants
    private function convertToBool($value)
    {
        switch ($value) {
            case "oui":
                return $value = TRUE;
                break;
            case "non":
                return $value = FALSE;
                break;
            case (!isset($value)):
                return $value = FALSE;
                break;
        }
    }


    public function importTags($fileTags)
    {
        // A tester sans le while
        $splFileTags = $this->fileInit($fileTags);
        $totalLines = $this->countLines($splFileTags);
        while (!$splFileTags->eof()) {
            foreach ($splFileTags as $row) {

                list($name, $description) = $row;
                $tag = $this->em->getRepository(Tag::class)
                    ->findOneBy([
                        'name' => $name,
                    ]);
                if (null === $tag) {
                    $tag = new Tag();
                    $tag->setName($name);
                    $tag->setDescription($description);
                    $slug = $this->slugificator->slugFactory($name);
                    $tag->setSlug($slug);
                    $this->em->persist($tag);
                    $this->em->flush();
                }

            }
        }
    }

    public function importSoftware($softFile)
    {
        $splSoftFile = $this->fileInit($softFile);
        $totalLines = $this->countLines($splSoftFile);
        while (!$splSoftFile->eof()) {
            foreach ($splSoftFile as $row) {
                list($name, $type, $description, $comments, $advantages,$drawbacks,/*versus1 et 2?*/, $rgpd, $customers, $hostingCountry, $creationDate, $annualTurnover, $configCost, $subscriptionCost, $trainingCost, $website, $isEmail, $isSms, $isPopin, $isMailpostal, $isCallCenter, $isPushMobile, $isApi, $isLandingPage, $isForm, $isTracking, $isLiveChat, $isContactObject, $isCompanyObject, $isDefinedFields, $isIllimitedfields, $isImportCsv, $isAutoDuplicate, $isLeadStages, $isSegmentCreation, $isIntelligentSegment, $isLeadScoring, $isCreationCampaign, $isDripMarketingCampaign, $isDragAndDrop, $isTwitterMonitoring, $isTwitterAutoPublication, $isFacebookMonitoring, $isFacebookAutoPublication, $isLinkedinMonitoring, $isLinkedinAutoPublication, $isInstagramMonitoring, $isInstagramAutopPublication, $isActivityReportCreation, $isActivityReportPeriodicSend, $isEmailSupport, $isPhoneSupport, $isChatSupport, $isKnowledgeBase, $KnowledgeBaseLanguage, $isTechnicalDocument, $isProviderEmailChoice, $isBlogEdition, $isTouchPad, $isSmtpRelay, $isRssToEmail) = $row;
                $soft = $this->em->getRepository(SoftMain::class)
                    ->findOneBy([
                        'name' => $name,
                    ]);
                if (null === $soft) {
                    //Faire la boucle de vérif ici
                    $softMain = new SoftMain();
                    $softMain->setName($name);
                    $slug = $this->slugificator->slugFactory($name);
                    $softMain->setSlug($slug);
                    //ajouter le path de l'image, à décider mais de type:
                    //$softMain->setLogoUrl("/my/path/' . $this->slugificator->slugFactory($name) . '.png");
                    $softMain->setType($type);
                    $softMain->setDescription($description);
                    $softMain->setComments($comments);
                    $softMain->setAdvantages($advantages);
                    $softMain->setDrawbacks($drawbacks);

                    $softInfo = new SoftInfo();
                    $softInfo->setRgpd($rgpd);
                    $softInfo->setCustomers($customers);
                    $softInfo->setHostingCountry($hostingCountry);
                    $softInfo->setCreationDate($creationDate);
                    $softInfo->setAnnualTurnover($annualTurnover);
                    $softInfo->setConfigCost($configCost);
                    $softInfo->setSubscriptionCost($subscriptionCost);
                    $softInfo->setTrainingCost($trainingCost);
                    $softInfo->setWebSite($website);

                    $softOutbound = new SoftOutbound();
                    $softOutbound->setIsEmail($isEmail);
                    $softOutbound->setIsSms($isSms);
                    $softOutbound->setIsPopin($isPopin);
                    $softOutbound->setIsMailPostal($isMailpostal);
                    $softOutbound->setIsCallCenter($isCallCenter);
                    $softOutbound->setIsPushMobile($isPushMobile);
                    $softOutbound->setIsApi($isApi);

                    $softComm = new SoftCommSupport();
                    $softComm->setIsLandingPage($isLandingPage);
                    $softComm->setIsForm($isForm);
                    $softComm->setIsTracking($isTracking);
                    $softComm->setIsLiveChat($isLiveChat);

                    $softLeadOp = new SoftLeadsOperation();
                    $softLeadOp->setIsContactObject($isContactObject);
                    $softLeadOp->setIsCompanyObject($isCompanyObject);
                    $softLeadOp->setIsDefinedFields($isDefinedFields);
                    $softLeadOp->setIsIllimitedFields($isIllimitedfields);
                    $softLeadOp->setIsImportCsv($isImportCsv);
                    $softLeadOp->setIsAutoDuplicate($isAutoDuplicate);
                    $softLeadOp->setIsLeadStages($isLeadStages);

                    $softSegmentOp = new SoftSegmentOperation();
                    $softSegmentOp->setIsSegmentCreation($isSegmentCreation);
                    $softSegmentOp->setIsIntelligentSegment($isIntelligentSegment);

                    $softMarketing = new SoftMarketingCampaign();
                    $softMarketing->setIsLeadScoring($isLeadScoring);
                    $softMarketing->setIsCreationCampaign($isCreationCampaign);
                    $softMarketing->setIsDripMarketingCampaign($isDripMarketingCampaign);
                    $softMarketing->setIsDragAndDrop($isDragAndDrop);

                    $softSocial = new SoftSocialMedia();
                    $softSocial->setIsTwitterMonitoring($isTwitterMonitoring);
                    $softSocial->setIsTwitterAutoPublication($isTwitterAutoPublication);
                    $softSocial->setIsFacebookMonitoring($isFacebookMonitoring);
                    $softSocial->setIsFacebookAutoPublication($isFacebookAutoPublication);
                    $softSocial->setIsLinkedinMonitoring($isLinkedinMonitoring);
                    $softSocial->setIsLinkedinAutoPublication($isLinkedinAutoPublication);
                    $softSocial->setIsInstagramMonitoring($isInstagramMonitoring);
                    $softSocial->setIsInstagramAutoPublication($isInstagramAutopPublication);

                    $softReport = new SoftReport();
                    $softReport->setIsActivityReportCreation($isActivityReportCreation);
                    $softReport->setIsActivityReportPeriodicSend($isActivityReportPeriodicSend);

                    $softSupport = new SoftSupport();
                    $softSupport->setIsEmailSupport($isEmailSupport);
                    $softSupport->setIsPhoneSupport($isPhoneSupport);
                    $softSupport->setIsChatSupport($isChatSupport);
                    $softSupport->setIsKnowledgeBase($isKnowledgeBase);
                    $softSupport->setKnowledgeBaseLanguage($KnowledgeBaseLanguage);
                    $softSupport->setIsTechnicalDocument($isTechnicalDocument);

                    $softOthers = new SoftOtherFunctionnalities();
                    $softOthers->setIsProviderEmailChoice($isProviderEmailChoice);
                    $softOthers->setIsBlogEdition($isBlogEdition);
                    $softOthers->setIsTouchPad($isTouchPad);
                    $softOthers->setIsSmtpRelay($isSmtpRelay);
                    $softOthers->setIsRssToEmail($isRssToEmail);

                    $this->em->persist($tag);
                    $this->em->flush();
                }

            }
        }

    }

    public function importVersus($data)
    {
        $this->fileInit($data);
        // From csv, check if data is correct, if is not, return error

    }

    public function getErrors()
    {
        return $this->errors;
    }

    private function fileInit($fileFromConsole)
    {
        //by default delimiter is ","

        // Si c'est un fichier, on créé une nouvelle instance de SplFileObject
        $file = new \SplFileObject($fileFromConsole);

        // On définit les drapeaux : saute la ligne si elle est vide

        $file->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE);

        return $file;
    }

    private function countLines(\SplFileObject $file){

        // On va à la fin max du fichier
        $file->seek(PHP_INT_MAX);

        // On récupère le nombre de lignes et on hydrate la propriété avec
        $totalLines = $file->key() + 1;

        // On remonte le pointeur au début du fichier
        $file->seek(0);

        return $totalLines;
    }
}