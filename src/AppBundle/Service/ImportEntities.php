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
                /*
                list($name, $type, $description, $comments, $advantages,$drawbacks,$rgpd, $customers, $hostingCountry, $creationDate, $annualTurnover, $configCost, $subscriptionCost, $trainingCost, $website, $isEmail, $isSms, $isPopin, $isMailpostal, $isCallCenter, $isPushMobile, $isApi, $isLandingPage, $isForm, $isTracking, $isLiveChat, $isContactObject, $isCompanyObject, $isDefinedFields, $isIllimitedfields, $isImportCsv, $isAutoDuplicate, $isLeadStages, $isSegmentCreation, $isIntelligentSegment, $isLeadScoring, $isCreationCampaign, $isDripMarketingCampaign, $isDragAndDrop, $isTwitterMonitoring, $isTwitterAutoPublication, $isFacebookMonitoring, $isFacebookAutoPublication, $isLinkedinMonitoring, $isLinkedinAutoPublication, $isInstagramMonitoring, $isInstagramAutopPublication, $isActivityReportCreation, $isActivityReportPeriodicSend, $isEmailSupport, $isPhoneSupport, $isChatSupport, $isKnowledgeBase, $KnowledgeBaseLanguage, $isTechnicalDocument, $isProviderEmailChoice, $isBlogEdition, $isTouchPad, $isSmtpRelay, $isRssToEmail) = $row; */
                $soft = $this->em->getRepository(SoftMain::class)
                    ->findOneBy([
                        'name' => $row[0],
                    ]);
                if (null === $soft) {
                    for ($i = 0; $i < 60; $i++) {
                        if ($row[$i] === 'false' || $row[$i] === "") {
                            $row[$i] = 0;
                        }
                        if ($row[$i] === 'true') {
                            $row[$i] = 1;
                        }
                    }
                    //Faire la boucle de vérif et de changement en bool ici
                    $softMain = new SoftMain();
                    $softMain->setName($row[0]);
                    $slug = $this->slugificator->slugFactory($row[0]);
                    $softMain->setSlug($slug);
                    //ajouter le path de l'image, à décider mais de type:
                    //$softMain->setLogoUrl("/my/path/' . $this->slugificator->slugFactory($name) . '.png");
                    $softMain->setType($row[1]);
                    $softMain->setDescription($row[2]);
                    $softMain->setComments($row[3]);
                    $softMain->setAdvantages($row[4]);
                    $softMain->setDrawbacks($row[5]);

                    $softInfo = new SoftInfo();
                    $softInfo->setRgpd($row[6]);
                    $softInfo->setCustomers($row[7]);
                    $softInfo->setHostingCountry($row[8]);
                    $softInfo->setCreationDate($row[9]);
                    $softInfo->setAnnualTurnover($row[10]);
                    $softInfo->setConfigCost($row[11]);
                    $softInfo->setSubscriptionCost($row[12]);
                    $softInfo->setTrainingCost($row[13]);
                    $softInfo->setWebSite($row[14]);


                    $softOutbound = new SoftOutbound();
                    $softOutbound->setIsEmail($row[15]);
                    $softOutbound->setIsSms($row[16]);
                    $softOutbound->setIsPopin($row[17]);
                    $softOutbound->setIsMailPostal($row[18]);
                    $softOutbound->setIsCallCenter($row[19]);
                    $softOutbound->setIsPushMobile($row[20]);
                    $softOutbound->setIsApi($row[21]);


                    $softComm = new SoftCommSupport();
                    $softComm->setIsLandingPage($row[22]);
                    $softComm->setIsForm($row[23]);
                    $softComm->setIsTracking($row[24]);
                    $softComm->setIsLiveChat($row[25]);


                    $softLeadOp = new SoftLeadsOperation();
                    $softLeadOp->setIsContactObject($row[26]);
                    $softLeadOp->setIsCompanyObject($row[27]);
                    $softLeadOp->setIsDefinedFields($row[28]);
                    $softLeadOp->setIsIllimitedFields($row[29]);
                    $softLeadOp->setIsImportCsv($row[30]);
                    $softLeadOp->setIsAutoDuplicate($row[31]);
                    $softLeadOp->setIsLeadStages($row[32]);


                    $softSegmentOp = new SoftSegmentOperation();
                    $softSegmentOp->setIsSegmentCreation($row[33]);
                    $softSegmentOp->setIsIntelligentSegment($row[34]);


                    $softMarketing = new SoftMarketingCampaign();
                    $softMarketing->setIsLeadScoring($row[35]);
                    $softMarketing->setIsCreationCampaign($row[36]);
                    $softMarketing->setIsDripMarketingCampaign($row[37]);
                    $softMarketing->setIsDragAndDrop($row[38]);


                    $softSocial = new SoftSocialMedia();
                    $softSocial->setIsTwitterMonitoring($row[39]);
                    $softSocial->setIsTwitterAutoPublication($row[40]);
                    $softSocial->setIsFacebookMonitoring($row[41]);
                    $softSocial->setIsFacebookAutoPublication($row[42]);
                    $softSocial->setIsLinkedinMonitoring($row[43]);
                    $softSocial->setIsLinkedinAutoPublication($row[44]);
                    $softSocial->setIsInstagramMonitoring($row[45]);
                    $softSocial->setIsInstagramAutoPublication($row[46]);


                    $softReport = new SoftReport();
                    $softReport->setIsActivityReportCreation($row[47]);
                    $softReport->setIsActivityReportPeriodicSend($row[48]);


                    $softSupport = new SoftSupport();
                    $softSupport->setIsEmailSupport($row[49]);
                    $softSupport->setIsPhoneSupport($row[50]);
                    $softSupport->setIsChatSupport($row[51]);
                    $softSupport->setIsKnowledgeBase($row[52]);
                    $softSupport->setKnowledgeBaseLanguage($row[53]);
                    $softSupport->setIsTechnicalDocument($row[54]);


                    $softOthers = new SoftOtherFunctionnalities();
                    $softOthers->setIsProviderEmailChoice($row[55]);
                    $softOthers->setIsBlogEdition($row[56]);
                    $softOthers->setIsTouchPad($row[57]);
                    $softOthers->setIsSmtpRelay($row[58]);
                    $softOthers->setIsRssToEmail($row[59]);


                    $softMain->setSoftInfo($softInfo);
                    $softMain->setSoftOutbound($softOutbound);
                    $softMain->setSoftCommSupport($softComm);
                    $softMain->setSoftLeadsOperation($softLeadOp);
                    $softMain->setSoftSegmentOperation($softSegmentOp);
                    $softMain->setSoftMarketingCampaign($softMarketing);
                    $softMain->setSoftSocialMedia($softSocial);
                    $softMain->setSoftReport($softReport);
                    $softMain->setSoftSupport($softSupport);
                    $softMain->setSoftOtherFunctionnalities($softOthers);


                    $this->em->persist($softInfo);
                    $this->em->persist($softOutbound);
                    $this->em->persist($softComm);
                    $this->em->persist($softLeadOp);
                    $this->em->persist($softSegmentOp);
                    $this->em->persist($softMarketing);
                    $this->em->persist($softSocial);
                    $this->em->persist($softReport);
                    $this->em->persist($softSupport);
                    $this->em->persist($softOthers);
                    $this->em->persist($softMain);

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

    private function countLines(\SplFileObject $file)
    {

        // On va à la fin max du fichier
        $file->seek(PHP_INT_MAX);

        // On récupère le nombre de lignes et on hydrate la propriété avec
        $totalLines = $file->key() + 1;

        // On remonte le pointeur au début du fichier
        $file->seek(0);

        return $totalLines;
    }
}