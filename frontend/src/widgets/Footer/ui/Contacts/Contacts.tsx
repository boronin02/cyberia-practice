import { MaxIcon, TgIcon, VkIcon } from "@/shared/assets/icons";
import styles from "./Contacts.module.scss";
import { useContacts } from "@/entities/Footer/contacts/model/useContacts";
import Link from "next/link";

export const Contacts = () => {
  const { data, isLoading, isError } = useContacts();

  if (isError) {
    <div>Ошибка загрузки</div>;
  }
  const allContacts = data?.data || [];

  const filteredContacts = allContacts.filter((contact) => {
    return contact.kay === "phone" || contact.kay === "email" || contact.kay === "address";
  });

  return (
    <div className={styles.contacts}>
      {filteredContacts.map((contact) => (
        <div key={contact.kay} className="">
          {contact.value}
        </div>
      ))}
      <div className={styles.socials}>
        <TgIcon />
        <VkIcon />
        <MaxIcon />
      </div>
    </div>
  );
};
