# 🏛️ Database Schema Reference (Laravel Application)

## 📊 Entity Relationship Diagram (Mermaid - Optimized for Clarity)

```mermaid
erDiagram
    %% Core Entities (Ordered for cleaner layout)
    roles ||--o{ users : "has"
    items }|--o{ items_lost : "has lost record"
    payments ||--o{ id_replacements : "funds"

    %% User & Related
    roles {
        bigint id PK
        varchar type "Admin, Regular, ID Replacement Approvers, L&F Managers"
        timestamp created_at
        timestamp updated_at
    }

    users {
        bigint id PK
        bigint role_id FK "Foreign Key to roles"
        varchar name
        varchar email UK
        varchar password
        boolean active
        varchar user_image_url
    }

    %% Lost & Found Flow
    items {
        bigint id PK
        varchar name
        varchar type
        text description
    }

    items_lost {
        bigint id PK
        bigint item_id FK "Foreign Key to items"
        date date_lost
        varchar place_lost
        boolean taken "Nullable, Default: 0"
        int user_taken_id "User who recorded item as taken (not FK)"
    }

    items_claimed {
        bigint id PK
        bigint user_id FK "Foreign Key to users (claimer)"
        bigint item_lost_id FK "Foreign Key to items_lost"
        boolean verified
    }

    %% ID Replacement Flow
    payments {
        bigint id PK
        varchar method "Cash, Mpesa"
        int amount
        boolean verified
    }

    id_replacements {
        bigint id PK
        bigint user_id FK "Foreign Key to users (requester)"
        bigint payment_id FK "Foreign Key to payments"
        varchar id_lost "Reference/ID of the lost item"
        boolean approved
    }

    %% Define Cross-Group Relationships explicitly after grouping for clarity
    users ||--o{ items_claimed : claims
    users ||--o{ id_replacements : requests
    items_lost ||--o{ items_claimed : "claimed record"