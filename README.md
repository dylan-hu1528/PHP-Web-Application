# CSE3241 Database Systems
### Group project: A PHP Web Application
### Group 2: Yunxuan Hu, Bronson Brown, Bo Chen
### Project description
The BUR Drugs is one of the drug stores that help distributing the COVID vaccines. Vaccines are delivered to BUR in batches. Each batch contains certain quantity of doses with each dose stored in a vial marked with a tracking number. Doses in the same batch are from one vaccine manufacturer (e.g., Pfizer, Moderna, Johnson & Johnson, etc.) with the same expiration date. Any dose not used before it expires will be discarded. These doses will be marked ‘expired’ as opposed to ‘available’ or ‘used’ in the database.
This project implements a web tool that provides various functions described below.
1.	Patients will use the web tool to sign up to get the vaccine from BUR. Each patient will provide name, contact phone number, the earliest date he/she can take the vaccine, age, and priority (a number from 1 to 3 with 1 being the highest priority and 3 the least) when he/she signs up.  Age will be used to prioritize people in the same priority group. 
2.	Administrator at BUR will use the web tool to enter batches received. Your web tool will add the newly received shipment into the database and schedule appointments with as many patients on the wait list (due to the lack of enough vaccine to distribute) as possible based on their priorities. When scheduling the patients to come in, make sure the dose does not expire before the patient can come in, which is  determined by the patient’s available date. 
3.	Administrator at BUR can use the web tool to generate the following reports:
a.	Current inventory by the manufacturer including total amount received, distributed, expired, and available. 
b.	List of patients that have gotten the vaccine from BUR, including the date the patient is vaccinated, and the brand of the vaccine.
c.	List of patients that are currently scheduled to come in.
d.	List of patients that are still waiting for the vaccines. 
4.	Patients can use the tool to cancel their requests (only if they have not gotten the vaccine) by removing their information. In that case, any doses reserved for them will be sent back to the inventory and redistributed to other patients.
