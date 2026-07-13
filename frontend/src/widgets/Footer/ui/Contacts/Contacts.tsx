import { MaxIcon, TgIcon, VkIcon } from "@/shared/assets/icons";
import styles from "./Contacts.module.scss";
import { ContactResource } from "@/entities/contacts/api/types";

interface ContactsProps {
  contacts: ContactResource[];
}
export const Contacts = ({ contacts }: ContactsProps) => {
  return (
    <div className={styles.contacts}>
      {contacts.map((contact) => (
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
