ALTER TABLE `group` ADD `small_expenses` DOUBLE NULL DEFAULT '100' AFTER `ballots`;
ALTER TABLE `group` ADD `banking_fees` DOUBLE NULL DEFAULT '150' AFTER `ballots`;
ALTER TABLE `group` ADD `post_expenses` DOUBLE NULL DEFAULT '60' AFTER `ballots`;
ALTER TABLE `group` ADD `emailing_expenses` DOUBLE NULL DEFAULT '0' AFTER `ballots`;

-- Circonscriptions de l'étrnager n'ont pas de menues dépenses
UPDATE `group` SET small_expenses='0',emailing_expenses='300' WHERE id='32';
UPDATE `group` SET small_expenses='0',emailing_expenses='200' WHERE id='33';
UPDATE `group` SET small_expenses='0',emailing_expenses='230' WHERE id='34';
UPDATE `group` SET small_expenses='0',emailing_expenses='240' WHERE id='35';
UPDATE `group` SET small_expenses='0',emailing_expenses='200' WHERE id='36';
UPDATE `group` SET small_expenses='0',emailing_expenses='50' WHERE id='37';
UPDATE `group` SET small_expenses='0',emailing_expenses='200' WHERE id='38';
UPDATE `group` SET small_expenses='0',emailing_expenses='50' WHERE id='39';
UPDATE `group` SET small_expenses='0',emailing_expenses='200' WHERE id='40';
UPDATE `group` SET small_expenses='0',emailing_expenses='50' WHERE id='41';
UPDATE `group` SET small_expenses='0',emailing_expenses='200' WHERE id='42';


UPDATE `group` SET posters='126',ballots='76150',professions_de_foi='79958',amount_target='1753' WHERE id='3';
UPDATE `group` SET posters='302',ballots='224400',professions_de_foi='109636',amount_target='2644' WHERE id='4';
UPDATE `group` SET posters='400',ballots='219998',professions_de_foi='109999',amount_target='2826' WHERE id='5';
UPDATE `group` SET posters='105',ballots='150700',professions_de_foi='72728',amount_target='1633' WHERE id='6';
UPDATE `group` SET posters='250',ballots='132950',professions_de_foi='63755',amount_target='1737' WHERE id='7';
UPDATE `group` SET posters='140',ballots='161744',professions_de_foi='80872',amount_target='1837' WHERE id='8';
UPDATE `group` SET posters='406',ballots='198967',professions_de_foi='99483',amount_target='2651' WHERE id='9';
UPDATE `group` SET posters='100',ballots='155300',professions_de_foi='75292',amount_target='1669' WHERE id='10';
UPDATE `group` SET posters='360',ballots='239205',professions_de_foi='119602',amount_target='2924' WHERE id='11';
UPDATE `group` SET posters='300',ballots='197259',professions_de_foi='103014',amount_target='2516' WHERE id='12';
UPDATE `group` SET posters='150',ballots='151500',professions_de_foi='72599',amount_target='1712' WHERE id='13';
UPDATE `group` SET posters='200',ballots='166404',professions_de_foi='79420',amount_target='1945' WHERE id='14';
UPDATE `group` SET posters='90',ballots='130971',professions_de_foi='65485',amount_target='1469' WHERE id='16';
UPDATE `group` SET posters='300',ballots='168963',professions_de_foi='80602',amount_target='2177' WHERE id='17';
UPDATE `group` SET posters='255',ballots='156004',professions_de_foi='89780',amount_target='2192' WHERE id='18';
UPDATE `group` SET posters='150',ballots='173180',professions_de_foi='82842',amount_target='1894' WHERE id='19';
UPDATE `group` SET posters='90',ballots='93883',professions_de_foi='93883',amount_target='1928' WHERE id='20';
UPDATE `group` SET posters='330',ballots='211730',professions_de_foi='105865',amount_target='2626' WHERE id='21';
UPDATE `group` SET posters='213',ballots='104573',professions_de_foi='76022',amount_target='1730' WHERE id='22';
UPDATE `group` SET posters='90',ballots='163000',professions_de_foi='78750',amount_target='1726' WHERE id='23';
UPDATE `group` SET posters='189',ballots='180201',professions_de_foi='86482',amount_target='2030' WHERE id='24';
UPDATE `group` SET posters='183',ballots='109690',professions_de_foi='73176',amount_target='1668' WHERE id='25';
UPDATE `group` SET posters='240',ballots='166500',professions_de_foi='80141',amount_target='2009' WHERE id='27';
UPDATE `group` SET posters='160',ballots='193127',professions_de_foi='96563',amount_target='2153' WHERE id='28';
UPDATE `group` SET posters='150',ballots='137421',professions_de_foi='73500',amount_target='1721' WHERE id='29';
UPDATE `group` SET posters='135',ballots='157740',professions_de_foi='80000',amount_target='1800' WHERE id='30';
UPDATE `group` SET posters='150',ballots='183500',professions_de_foi='89931',amount_target='2018' WHERE id='31';
UPDATE `group` SET posters='118',ballots='138644',professions_de_foi='66171',amount_target='1556' WHERE id='43';
UPDATE `group` SET posters='180',ballots='182870',professions_de_foi='88784',amount_target='2053' WHERE id='44';
UPDATE `group` SET posters='150',ballots='130909',professions_de_foi='62479',amount_target='1548' WHERE id='45';
UPDATE `group` SET posters='324',ballots='236000',professions_de_foi='115543',amount_target='2789' WHERE id='46';
UPDATE `group` SET posters='200',ballots='173034',professions_de_foi='82564',amount_target='1994' WHERE id='47';
