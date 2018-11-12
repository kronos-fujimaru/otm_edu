# Opsys

## Models

### User

+ User
	+ id
	+ email
	+ password
	+ type
    + Participant,
	+ status

> Customize Laravel default User class.

### Cycles

+ Cycle
	+ id
  + user_id
	+ date
	+ condition
	+ motivation

### Training

+ Training
	+ id
	+ title
	+ place
	+ date_from
	+ date_to
	+ status
	+ instructor_id

### Instructor

+ Instructor
	+ id
	+ name
	+ icon_url
	+ icon_mime_type

### TrainingUser

+ TrainingUser
	+ id
	+ training_id
	+ user_id

### Exams

+ Exam
  + id
  + date
  + title
  + url
  + status
	+ trainig_id


### UserExam

+ UserExam
  + id
  + exam_id
  + user_id
  + score

### Question

+ Question
  + id
  + date
  + title
  + url
  + status
	+ trainig_id

### UserQuestion

+ UserExam
  + id
  + question_id
  + user_id
