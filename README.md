Clone the prject : 
git clone https://github.com/jeraldxavier/arizon.git

composer install

replace the DB name in .eve

php artisan migrate

**Login Credential**
email: jerald@yopmail.com 
password: Test@123

**API:**

**Login :**

mutation {
  login(email: "jerald@yopmail.com", password: "Test@123") {
    status
    message
    token
  }
}


**Create User:**

mutation {
  createUser(name: "John Doe", email:"jeraldxavier@yopmail.com", password:"Test@123") {
    id
    name
    email
    created_at
  }
}

**Post List**

query {
  posts {
    id
    title
    content
    created_at
  }
}

**Post Create**

mutation {
  createPost(title: "test", content: "This is content") {
    title
    content
  }
}

**Post Update**

mutation {
  updatePost(id: 2, title: "Updated Arizon") {
    id
    title
    content
  }
}

**Post Delete**

mutation {
  deletePost(id: 17) {
    id
  }
}

