<?php 
				   
				

 /*
 if ($_SESSION['droit']== "projet" ){ 
        echo '<li class="nav-item"><a class="nav-link" href="projet.php"> MES PROJETS</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="operation_debit.php">DEBIT</a></li>';
	echo '<li class="nav-item"><a class="nav-link" href="operation_credit.php">CREDIT</a></li>';
	echo '<li class="nav-item"><a class="nav-link" href="mouvement.php">MOUVEMENT_COMPTE</a></li>';
 
 }*/
 
  
    
    
 if ( $_SESSION['droit']== "admin"){ // accède à tout
 
  echo '<li class="nav-item"><a class="nav-link" href="gac.php">GA CONTRATS</a></li>'; 
  
  echo'<li class="nav-item dropdown" >
        <a href="" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">PARAMETRAGE</a>
        <div class="dropdown-menu">
            <a href="objectif.php" class="dropdown-item">OBJECTIFS ANNUELS</a>
            <a href="programme.php" class="dropdown-item">Programme</a>
            <a href="personnel.php" class="dropdown-item">Personnel</a>
            <a href="suivi_projet.php" class="dropdown-item">Projets</a>
            <a href="clients.php" class="dropdown-item">Clients</a>
            <a href="fourniss.php" class="dropdown-item">Fournisseurs</a>
        </div>
    </li>';
    
  echo'<li class="nav-item dropdown" >
        <a href="" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">Gestion Projet</a>
        <div class="dropdown-menu">
             <a href="planification.php" class="dropdown-item">PLANIFICATION</a>
             <a href="gestionnaire.php" class="dropdown-item">EXECUTION</a>
             <a href="supervision_1.php" class="dropdown-item">SUPERVISION</a>
        </div>
    </li>';
    
    
    echo'<li class="nav-item dropdown" >
        <a href="" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">ECHEANCIER</a>
        <div class="dropdown-menu">
             <a href="fourniss.php" class="dropdown-item">Fournisseur</a>
             <a href="clients.php" class="dropdown-item">Clients</a>
            <a href="echeancierdebit.php" class="dropdown-item">Echéancier Factures</a>
            <a href="echeanciercredit.php" class="dropdown-item">Echéancier Créances </a>
        </div>
    </li>';
    
 echo'<li class="nav-item dropdown" >
        <a href="devisfournisseurs.php" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">SOUMISSIONS</a>
        <div class="dropdown-menu">
            <a  href="soumissionnaire.php" class="dropdown-item">Soumissionnaires</a>
            <a  href="depouillement.php" class="dropdown-item">Dépouillement du marché</a>
            <a  href="marche_valide.php" class="dropdown-item">MARCHES VALIDES</a>
            <a  href="attribution.php" class="dropdown-item">ATTRIBUTION DES MARCHES</a>
            <a  href="montage.php" class="dropdown-item">MONTAGE DES MARCHES</a>
        </div>
    </li>';
    
     echo'<li class="nav-item dropdown" >
        <a href="devisfournisseurs.php" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">DEVIS Fournisseurs</a>
        <div class="dropdown-menu">
            <a href="devisfournisseurs.php" class="dropdown-item">DEVIS Fournisseurs</a>
            <a href="fournisseurs.php" class="dropdown-item">Fournisseurs</a>
        </div>
    </li>';
    
     echo'<li class="nav-item dropdown" >
        <a href="devisfournisseurs.php" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">ENGAGEMENT & FINANCEMENT</a>
        <div class="dropdown-menu">
            <a  href="financier.php" class="dropdown-item">Financier</a>
            <a  href="financement.php" class="dropdown-item">Financement</a>
            <a  href="engagement_relation.php" class="dropdown-item">Engagement des RP </a>
            
        </div>
    </li>';
    
     echo'<li class="nav-item dropdown" >
        <a href="devisfournisseurs.php" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">OPERATION DAAF</a>
        <div class="dropdown-menu">
            <a  href="engagement_facture.php" class="dropdown-item">ENGAGEMENT_FACTURE</a>
            <a  href="ca_operation.php" class="dropdown-item">OPERATION</a>  
            <a  href="ca_comptes.php" class="dropdown-item">COMPTES</a>
            <a  href="ca_creance.php" class="dropdown-item">CREANCES</a>
            <a  href="scc_recouvrement.php" class="dropdown-item">RECOUVREMENT</a>
            <a  href="ca_operation_debit.php" class="dropdown-item">ANCIEN DEBIT</a>
            <a  href="ca_operation_credit.php" class="dropdown-item">ANCIEN CREDIT</a>
            <a  href="ca_operation_mvt.php" class="dropdown-item">ANCIEN MOUVEMENT</a>
            
        </div>
    </li>';
    
       
      // echo '<li class="nav-item"><a class="nav-link" href="objectif.php">OBJECTIFS ANNUELS</a></li>';   
      // echo '<li class="nav-item"><a class="nav-link" href="projet.php"> PROJETS</a></li>';
     /*  echo '<li class="nav-item"><a class="nav-link" href="engagement_facture.php">ENGAGEMENT_FACTURE</a></li>';
       echo '<li class="nav-item"><a class="nav-link" href="operation_debit.php">DEBIT</a></li>';
       echo '<li class="nav-item"><a class="nav-link" href="operation_credit.php">CREDIT</a></li>';
       echo '<li class="nav-item"><a class="nav-link" href="creance.php">CREANCES</a></li>';
       echo '<li class="nav-item"><a class="nav-link" href="mouvement.php">MOUVEMENT_COMPTE</a></li>';*/
     //  echo '<li class="nav-item"><a class="nav-link" href="programme.php">PROGRAMME</a></li>';
      // echo '<li class="nav-item"><a class="nav-link" href="personnel.php">Personnel</a></li>';
	  
 }
 
 
 if ( $_SESSION['droit']== "saisie"){ // accède à tout
 
     echo'<li class="nav-item dropdown" >
        <a href="devisfournisseurs.php" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">DEVIS Fournisseurs</a>
        <div class="dropdown-menu">
            <a href="devisfournisseurs.php" class="dropdown-item">DEVIS Fournisseurs</a>
            <a href="fournisseurs.php" class="dropdown-item">Fournisseurs</a>
        </div>
    </li>';  
 }
 
 
  if ( $_SESSION['droit']== "budget"){
  
    echo '<li class="nav-item"><a class="nav-link" href="scc.php">GA CONTRATS</a></li>'; 
    
        echo'<li class="nav-item dropdown" >
        <a href="" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">ECHEANCIER</a>
        <div class="dropdown-menu">
             <a href="fourniss.php" class="dropdown-item">Fournisseur</a>
             <a href="clients.php" class="dropdown-item">Clients</a>
           <!-- <a href="echeancierdebit.php" class="dropdown-item">Echéancier Factures</a>
            <a href="echeanciercredit.php" class="dropdown-item">Echéancier Créances </a> -->
        </div>
    </li>';
    
  
        echo '<li class="nav-item"><a class="nav-link" href="projet.php"> PROJETS</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="engagement_facture.php">ENGAGEMENT_FACTURE</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="ca_operation.php">OPERATION</a></li>';
        
       // echo '<a  href="ca_comptes.php" class="dropdown-item">COMPTES</a>';
	echo '<li class="nav-item"><a class="nav-link" href="scc_creance.php">CREANCES</a></li>';
	echo '<li class="nav-item"><a class="nav-link" href="scc_recouvrement.php">RECOUVREMENT</a></li>';
	
	echo '<li class="nav-item"><a class="nav-link" href="ca_operation_debit.php">ANCIEN DEBIT</a></li>';
	echo '<li class="nav-item"><a class="nav-link" href="ca_operation_credit.php">ANCIEN CREDIT</a></li>';
	echo '<li class="nav-item"><a class="nav-link" href="ca_operation_mvt.php">ANCIEN MOUVEMENT</a></li>';
	
	   
            
  
  }
  
  
  if ( $_SESSION['droit']== "tresorerie"){
  
  echo '<li class="nav-item"><a class="nav-link" href="atc.php">GA CONTRATS</a></li>'; 
  
   echo'<li class="nav-item dropdown" >
        <a href="" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">ECHEANCIER</a>
        <div class="dropdown-menu">
            <a href="fourniss.php" class="dropdown-item">Fournisseur</a>
            <a href="clients.php" class="dropdown-item">Clients</a>
           <!-- <a href="echeancierdebit.php" class="dropdown-item">Echéancier Factures</a>
            <a href="echeanciercredit.php" class="dropdown-item">Echéancier Créances </a> -->
        </div>
    </li>';
  
        echo '<li class="nav-item"><a class="nav-link" href="engagement_facture.php">ENGAGEMENT_FACTURE</a></li>';
	echo '<li class="nav-item"><a class="nav-link" href="ca_operation.php">OPERATION</a></li>';
	echo '<li class="nav-item"><a class="nav-link" href="atc_creance.php">CREANCES</a></li>';
	// echo ' <a  href="ca_comptes.php" class="dropdown-item">COMPTES</a>';
	// echo '<li class="nav-item"><a class="nav-link" href="fiscale.php">Annee Fiscale </a></li>'; 
	
	echo '<li class="nav-item"><a class="nav-link" href="ca_operation_debit.php">ANCIEN DEBIT</a></li>';
	echo '<li class="nav-item"><a class="nav-link" href="ca_operation_credit.php">ANCIEN CREDIT</a></li>';
	echo '<li class="nav-item"><a class="nav-link" href="ca_operation_mvt.php">ANCIEN MOUVEMENT</a></li>';
	
	
	
  
  }
 
 
  
if ( $_SESSION['droit']== "superviseur"){

  echo '<li class="nav-item"><a class="nav-link" href="projetssuper.php">MES SUPERVISIONS</a></li>'; 
  echo '<li class="nav-item"><a class="nav-link" href="gac.php">GA CONTRATS</a></li>'; 
  
  echo'<li class="nav-item dropdown" >
        <a href="" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">ECHEANCIER</a>
        <div class="dropdown-menu">
            <a href="fourniss.php" class="dropdown-item">Fournisseur</a>
            <a href="clients.php" class="dropdown-item">Clients</a>
           <!-- <a href="echeancierdebit.php" class="dropdown-item">Echéancier Factures</a>
            <a href="echeanciercredit.php" class="dropdown-item">Echéancier Créances </a> -->
        </div>
    </li>';
    
    echo'<li class="nav-item dropdown" >
        <a href="devisfournisseurs.php" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">OPERATION DAAF</a>
        <div class="dropdown-menu">
            <a  href="engagement_facture.php" class="dropdown-item">ENGAGEMENT_FACTURE</a>
            <a  href="ca_operation.php" class="dropdown-item">OPERATION</a>  
            <a  href="ca_comptes.php" class="dropdown-item">COMPTES</a>
            <a  href="ca_creance.php" class="dropdown-item">CREANCES</a>
            <a  href="scc_recouvrement.php" class="dropdown-item">RECOUVREMENT</a>
            <a  href="ca_operation_debit.php" class="dropdown-item">ANCIEN DEBIT</a>
            <a  href="ca_operation_credit.php" class="dropdown-item">ANCIEN CREDIT</a>
            <a  href="ca_operation_mvt.php" class="dropdown-item">ANCIEN MOUVEMENT</a>
            
        </div>
    </li>';
 
  
   echo'<li class="nav-item dropdown" >
        <a href="devisfournisseurs.php" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">DEVIS Fournisseurs</a>
        <div class="dropdown-menu">
            <a href="devisfournisseurs.php" class="dropdown-item">DEVIS Fournisseurs</a>
            <a href="fournisseurs.php" class="dropdown-item">Fournisseurs</a>
        </div>
    </li>';
  
  if ($_SESSION['idu'] ==3  ||  $_SESSION['idu'] == 11) { // CLAIRE et DG
  
        echo '<li class="nav-item"><a class="nav-link" href="projet.php"> TOUS LES PROJETS</a></li>';
        
       // echo '<li class="nav-item"><a class="nav-link" href="engagement.php">ENGAGEMENTS</a></li>';
       // echo '<li class="nav-item"><a class="nav-link" href="ca_operation.php">OPERATION</a></li>';
	//echo '<li class="nav-item"><a class="nav-link" href="mouvement.php">MOUVEMENT_COMPTE</a></li>';
	//echo '<li class="nav-item"><a class="nav-link" href="ca_comptes.php">COMPTES</a></li>';
	
	
	
   
  }
  
  if ($_SESSION['idu'] == 11 ) { //  DG
     
     echo'<li class="nav-item dropdown" >
        <a href="devisfournisseurs.php" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">ENGAGEMENT & FINANCEMENT</a>
        <div class="dropdown-menu">
            <a  href="financier.php" class="dropdown-item">Financier</a>
            <a  href="financement.php" class="dropdown-item">Financement</a>
            <a  href="engagement_relation.php" class="dropdown-item">Engagement des RP </a>
            
        </div>
    </li>';
  
  }
  
  if ($_SESSION['idu'] == 3  ||  $_SESSION['idu'] == 15) { //  DG
   
    echo'<li class="nav-item dropdown" >
        <a href="devisfournisseurs.php" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">SOUMISSIONS</a>
        <div class="dropdown-menu">
            <a  href="soumissionnaire.php" class="dropdown-item">Soumissionnaires</a>
            <a  href="depouillement.php" class="dropdown-item">Dépouillement du marché</a>
            <a  href="marche_valide.php" class="dropdown-item">MARCHES VALIDES</a>
            <a  href="attribution.php" class="dropdown-item">ATTRIBUTION DES MARCHES</a>
            <a  href="montage.php" class="dropdown-item">MONTAGE DES MARCHES</a>
        </div>
    </li>';
    
      echo'<li class="nav-item dropdown" >
        <a href="devisfournisseurs.php" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">ENGAGEMENT & FINANCEMENT</a>
        <div class="dropdown-menu">
            <a  href="financier.php" class="dropdown-item">Financier </a>
            <a  href="financement.php" class="dropdown-item">Financement</a>
            <a  href="engagement_relation.php" class="dropdown-item">Engagement des RP </a>
            
        </div>
    </li>';
    
    echo '<li class="nav-item"><a class="nav-link" href="objectif.php">OBJECTIFS ANNUELS</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="ca_creance.php">CREANCES</a></li>';
    echo ' <li class="nav-item"> <a class="nav-link" href="planification.php">PLANIFICATION</a></li>';
    echo ' <li class="nav-item"> <a class="nav-link" href="gestionnaire.php">EXECUTION</a></li>';
    echo ' <li class="nav-item"> <a class="nav-link" href="supervision_1.php">SUPERVISION</a></li>';
    
    /*echo'<li class="nav-item dropdown" >
        <a href="devisfournisseurs.php" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">OPERATION DAAF</a>
        <div class="dropdown-menu">
            <a  href="engagement_facture.php" class="dropdown-item">ENGAGEMENT_FACTURE</a>
            <a  href="ca_operation.php" class="dropdown-item">OPERATION</a>  
            <a  href="ca_comptes.php" class="dropdown-item">COMPTES</a>
            <a  href="ca_creance.php" class="dropdown-item">CREANCES</a>
            <a  href="scc_recouvrement.php" class="dropdown-item">RECOUVREMENT</a>
            <a  href="ca_operation_debit.php" class="dropdown-item">ANCIEN DEBIT</a>
            <a  href="ca_operation_credit.php" class="dropdown-item">ANCIEN CREDIT</a>
            <a  href="ca_operation_mvt.php" class="dropdown-item">ANCIEN MOUVEMENT</a>
            
        </div>
    </li>';*/
     
          /*
         echo '<li class="nav-item"><a class="nav-link" href="soumissionnaire.php">Soumissionnaires</a></li>';
  	 echo '<li class="nav-item"><a class="nav-link" href="depouillement.php">Dépouillement du marché</a></li>';
  	 echo ' <li class="nav-item"> <a class="nav-link" href="marche_valide.php">MARCHES VALIDES</a></li>';
  	 echo ' <li class="nav-item"> <a class="nav-link" href="attribution.php">ATTRIBUTION DES MARCHES</a></li>';
   	 echo ' <li class="nav-item"> <a class="nav-link" href="montage.php">MONTAGE DES MARCHES</a></li>'; */
   
  }
  
}
  
if ( $_SESSION['droit']== "gestionnaire"){
  
   echo'<li class="nav-item dropdown" >
        <a href="" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">ECHEANCIER</a>
        <div class="dropdown-menu">
            <a href="fourniss.php" class="dropdown-item">Fournisseur</a>
            <a href="clients.php" class="dropdown-item">Clients</a>
            <a href="echeancierdebit.php" class="dropdown-item">Echéancier Factures</a>
            <a href="echeanciercredit.php" class="dropdown-item">Echéancier Créances </a>
        </div>
    </li>';
    
         echo'<li class="nav-item dropdown" >
        <a href="devisfournisseurs.php" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">DEVIS Fournisseurs</a>
        <div class="dropdown-menu">
            <a href="devisfournisseurs.php" class="dropdown-item">DEVIS Fournisseurs</a>
            <a href="fournisseurs.php" class="dropdown-item">Fournisseurs</a>
          </div>
         </li>';

         echo '<li class="nav-item"><a class="nav-link" href="mesprojets.php">MES PROJETS</a></li>';
        // echo ' <li class="nav-item"> <a class="nav-link" href="planification.php">PLANIFICATION</a></li>';
         echo ' <li class="nav-item"> <a class="nav-link" href="gestionnaire.php">EXECUTION</a></li>';
         
         
	 
 }
 
 if ($_SESSION['droit']== "utilisateur" ){
         
     echo'<li class="nav-item dropdown" >
        <a href="devisfournisseurs.php" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">DEVIS Fournisseurs</a>
        <div class="dropdown-menu">
            <a href="devisfournisseurs.php" class="dropdown-item">DEVIS Fournisseurs</a>
            <a href="fournisseurs.php" class="dropdown-item">Fournisseurs</a>
        </div>
    </li>';
 
	 echo '<li class="nav-item"><a class="nav-link" href="projet.php">MES PROJETS</a></li>';
	 echo '<li class="nav-item"><a class="nav-link" href="engagement.php">MES ENGAGEMENTS</a></li>';
	 echo '<li class="nav-item"><a class="nav-link" href="ca_operation.php">OPERATION</a></li>';
	 
 }
 
 if ( $_SESSION['droit']== "infos_marche"){
  
  
        echo '<li class="nav-item"><a class="nav-link" href="marche_valide.php"> MARCHES VALIDE</a></li>';

  }

if ($_SESSION['droit']== "dcao" ){
         
 /*   echo'<li class="nav-item dropdown" >
       <a href="devisfournisseurs.php" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">DEVIS Fournisseurs</a>
       <div class="dropdown-menu">
           <a href="devisfournisseurs.php" class="dropdown-item">DEVIS Fournisseurs</a>
           <a href="fournisseurs.php" class="dropdown-item">Fournisseurs</a>
       </div>
   </li>';*/
   echo '<li class="nav-item"><a class="nav-link" href="soumissionnaire.php">Soumissionnaires</a></li>';
   echo '<li class="nav-item"><a class="nav-link" href="depouillement.php">Dépouillement du marché</a></li>';
   echo ' <li class="nav-item"> <a class="nav-link" href="marche_valide.php">MARCHES VALIDES</a></li>';
   echo ' <li class="nav-item"> <a class="nav-link" href="attribution.php">ATTRIBUTION DES MARCHES</a></li>';
   echo ' <li class="nav-item"> <a class="nav-link" href="montage.php">MONTAGE DES MARCHES</a></li>';
   
/*
    echo '<li class="nav-item"><a class="nav-link" href="projet.php">MES PROJETS</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="engagement.php">MES ENGAGEMENTS</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="operation_debit.php">MES DEBITS</a></li>';
  
    */  
}

if ($_SESSION['droit']== "sdao" ){
         
   /* echo'<li class="nav-item dropdown" >
       <a href="devisfournisseurs.php" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">DEVIS Fournisseurs</a>
       <div class="dropdown-menu">
           <a href="devisfournisseurs.php" class="dropdown-item">DEVIS Fournisseurs</a>
           <a href="fournisseurs.php" class="dropdown-item">Fournisseurs</a>
       </div>
   </li>';*/
  // echo ' <li class="nav-item"> <a class="nav-link" href="marche_valide.php">MARCHES VALIDES</a></li>';
 //  echo ' <li class="nav-item"> <a class="nav-link" href="attribution.php">ATTRIBUTION DES MARCHES</a></li>';
   echo ' <li class="nav-item"> <a class="nav-link" href="montage.php">MONTAGE DES MARCHES</a></li>'; 
   
    echo'<li class="nav-item dropdown" >
        <a href="" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">GESTION EXPERT</a>
        <div class="dropdown-menu">
             <a href="expert.php" class="dropdown-item">Expert</a>
             <a href="diplome.php" class="dropdown-item">Diplome</a>
            <a href="cv.php" class="dropdown-item">Les CV</a>
            <a href="certification.php" class="dropdown-item">Certifications</a>
        </div>
    </li>';
    
    echo ' <li class="nav-item"> <a class="nav-link" href="reference.php">REFERENCES</a></li>'; 
    
}
if ($_SESSION['droit']== "sdcao" ){
         
    /* echo'<li class="nav-item dropdown" >
        <a href="devisfournisseurs.php" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">DEVIS Fournisseurs</a>
        <div class="dropdown-menu">
            <a href="devisfournisseurs.php" class="dropdown-item">DEVIS Fournisseurs</a>
            <a href="fournisseurs.php" class="dropdown-item">Fournisseurs</a>
        </div>
    </li>';*/
    echo ' <li class="nav-item"> <a class="nav-link" href="marche_valide.php">MARCHES VALIDES</a></li>';
    echo ' <li class="nav-item"> <a class="nav-link" href="attribution.php">ATTRIBUTION DES MARCHES</a></li>';
   // echo ' <li class="nav-item"> <a class="nav-link" href="montage.php">MONTAGE DES MARCHES</a></li>'; 
 }

if ($_SESSION['droit']== "planification" ){
    
    echo ' <li class="nav-item"> <a class="nav-link" href="planification.php">PLANIFICATION</a></li>';
   // echo ' <li class="nav-item"> <a class="nav-link" href="attribution.php">ATTRIBUTION DES MARCHES</a></li>';
   
 }
 
 /*
 if ($_SESSION['droit']== "execution" ){
    
    echo ' <li class="nav-item"> <a class="nav-link" href="planification_1.php">PLANIFICATION</a></li>';
    echo ' <li class="nav-item"> <a class="nav-link" href="execution_1.php">EXECUTION</a></li>';
   
 }
 
  if ($_SESSION['droit']== "supervision" ){
    
    echo ' <li class="nav-item"> <a class="nav-link" href="planification_1.php">PLANIFICATION</a></li>';
    echo ' <li class="nav-item"> <a class="nav-link" href="execution_1.php">EXECUTION</a></li>';
    echo ' <li class="nav-item"> <a class="nav-link" href="supervision_1.php">SUPERVISION</a></li>';
    
 }*/
 
 
 
 if ($_SESSION['droit']== "suivi_evaluation" ){ 
      
       echo'<li class="nav-item dropdown" >
        <a href="" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">PARAMETRAGE</a>
        <div class="dropdown-menu">
            <a href="objectif.php" class="dropdown-item">OBJECTIFS ANNUELS</a>
            <a href="programme.php" class="dropdown-item">Programme</a>
            <a href="personnel.php" class="dropdown-item">Personnel</a>
            <a href="seval_projet.php" class="dropdown-item">Projets</a>
            <a href="clients.php" class="dropdown-item">Clients</a>
            <a href="fourniss.php" class="dropdown-item">Fournisseurs</a>
        </div>
    </li>';
 
  
     //  echo '<li class="nav-item"><a class="nav-link" href="suivi_projet.php"> PROJETS</a></li>';
       echo '<li class="nav-item"><a class="nav-link" href="suivi.php">GA CONTRATS</a></li>'; 
       
 }
 
 /*
 echo'<li class="nav-item dropdown" >
        <a href="" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">User</a>
        <div class="dropdown-menu">
            <a href="resetpass.php" class="dropdown-item">RESET_PASS</a>
            <a href="deconnexion.php" class="dropdown-item">DECONNEXION</a>
        </div>
    </li>';*/
    
 echo ' <li class="nav-item"> <a class="nav-link" href="resetpass.php">RESET_PASS</a></li>';
 echo ' <li class="nav-item"> <a class="nav-link" href="deconnexion.php">DECONNEXION</a></li>';


    ?>