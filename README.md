# 🛠️ NexelTools

NexelTools is an online **tool marketplace** developed as a full-stack project, combining a web application, REST API and Android mobile application.

The project was designed to simulate a complete e-commerce platform for the sale of tools, including a **Front Office**, **Back Office**, REST API and mobile application.

## 🚀 Features

### 🌐 Front Office

The customer-facing website provides the main shopping experience.

* Product browsing and shopping cart
* Product search and filtering
* Product details
* Favorites
* User registration and authentication
* Fake Checkout and payment methods
* Shipping methods
* Product ratings
* Responsive interface

### ⚙️ Back Office

An administration area for managing the platform.

* User management
* Product management
* Category management
* Product image management
* Product and order management
* Role and permission management
* Administrative dashboard

### 📱 Android Application

A native Android application developed in **Java**, consuming the REST API developed.

* Product browsing
* Product search
* User authentication
* Favorites
* Shopping cart
* Product management
* User profile
* API communication using **Volley**

## 🏗️ Architecture

NexelTools is composed of a web application, a REST API and a native Android application.

The **Front Office** and **Back Office** are part of the Yii2 web application and communicate directly with the application's Controllers and Models.

The **REST API** is a separate layer used mainly by the Android application.

```text
                        ┌─────────────────────────┐
                        │      Yii2 Web App       │
                        │                         │
                        │  ┌───────────────────┐  │
                        │  │    Front Office   │  │
                        │  └─────────┬─────────┘  │
                        │            │            │
                        │  ┌─────────▼─────────┐  │
                        │  │    Controllers    │  │
                        │  └─────────┬─────────┘  │
                        │            │            │
                        │  ┌─────────▼─────────┐  │
                        │  │      Models       │  │
                        │  └─────────┬─────────┘  │
                        │            │            │
                        │  ┌─────────▼─────────┐  │
                        │  │     Back Office   │  │
                        │  └───────────────────┘  │
                        └────────────┬────────────┘
                                     │
                                     ▼
                              ┌─────────────┐
                              │    MySQL    │
                              └─────────────┘


                  ┌──────────────────────┐
                  │    Android App       │
                  │    Java + Volley     │
                  └──────────┬───────────┘
                             │
                             │ HTTP Requests
                             ▼
                  ┌──────────────────────┐
                  │      REST API        │
                  │        Yii2          │
                  └──────────┬───────────┘
                             │
                             ▼
                      ┌─────────────┐
                      │    MySQL    │
                      └─────────────┘
```

### 🌐 Web Application

The web application was developed using **Yii2** following the **MVC architecture**.

The Front Office and Back Office use Yii2's Controllers and Models directly instead of communicating through the REST API.

```text
User
 │
 ▼
Yii2 View
 │
 ▼
Controller
 │
 ▼
Model
 │
 ▼
MySQL
```

### 📡 REST API

A separate REST API was implemented using Yii2 to provide data and functionality to external clients.

The Android application consumes this API through HTTP requests.

```text
Android Application
        │
        │ HTTP
        ▼
    REST API
        │
        ▼
      Model
        │
        ▼
      MySQL
```

### 📱 Android Application

The Android application was developed in **Java** and communicates with the REST API using **Volley**.

A `SingletonAPI` was implemented to centralize API requests and manage the Volley request queue.

```text
Android
   │
   ▼
SingletonAPI
   │
   ▼
Volley
   │
   ▼
REST API
   │
   ▼
MySQL
```


## 🛠️ Tech Stack

### Backend

* **PHP**
* **Yii2 Framework**
* **MVC Architecture**
* **REST API**
* **MySQL**
* **RBAC**

### Frontend

* **HTML5**
* **CSS3**
* **JavaScript**
* **jQuery**
* **Bootstrap**
* **AdminLTE**

### Mobile

* **Java**
* **Android**
* **Volley**
* **Glide**

### Other Technologies

* **Mosquitto**
* **MQTT**
* **Git / GitHub**

## 📡 REST API

The API handles operations such as:

* Authentication
* Products
* Favorites
* Shopping cart
* User profile
* Fake Checkout


## 📱 Android API Communication

The Android application communicates with the REST API using **Volley**.

Example architecture:

```text
Android Application
        │
        ▼
   SingletonAPI
        │
        ▼
      Volley
        │
        ▼
     REST API
        │
        ▼
      Yii2
        │
        ▼
      MySQL
```

A `SingletonAPI` pattern was used to centralize API requests and manage the Volley request queue throughout the application.

## 📡 MQTT & Mosquitto

The project also included **MQTT communication using Mosquitto**.

Mosquitto was used as the MQTT broker, allowing applications and services to communicate through a publish/subscribe messaging system.

```text
Publisher
    │
    │ MQTT
    ▼
Mosquitto Broker
    │
    │ MQTT
    ▼
Subscriber
```

This provided experience with asynchronous communication and event-driven architectures.

## 🏛️ MVC Architecture

The backend follows the **Model-View-Controller (MVC)** pattern provided by Yii2.

```text
Request
   │
   ▼
Controller
   │
   ├──► Model ───► Database
   │
   ▼
View / Response
```

This separation helped keep the application organized and maintainable.

## 🔐 Authentication & Authorization

The application includes user authentication and role-based access control.

Different user roles were implemented, including:

* Administrator
* User

The Back Office was protected using **RBAC (Role-Based Access Control)** to restrict administrative functionality according to user permissions.


## 🎯 Project Goals

NexelTools was developed as a complete software project to put into practice different areas of software development, including:

* Full-stack web development
* MVC architecture
* REST API development
* Android development
* API integration
* Database design
* Authentication and authorization
* RBAC
* CRUD operations
* E-commerce functionality
* Mobile/web integration
* MQTT communication
* Software architecture

## 📚 What I Learned

Through this project, I gained practical experience in developing and integrating multiple applications around a common backend.

The project allowed me to work with:

* **Yii2 and MVC architecture**
* **PHP**
* **REST APIs**
* **MySQL**
* **Java and Android**
* **Volley**
* **MQTT and Mosquitto**
* **RBAC**
* **Frontend and Back Office development**
* **Mobile API integration**
* **E-commerce workflows**

## 👨‍💻 Author

**Diogo Godinho**

NexelTools — Full-stack e-commerce project combining **Yii2, PHP, MySQL, REST API, Android, Java, Volley, MQTT and Mosquitto**.
