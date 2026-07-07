import styles from "./Social.module.scss";
import { MaxIcon, TgIcon, VkIcon } from "@/shared/assets/icons";

export const Social = () => {
  return (
    <div className={styles.social}>
      <TgIcon />
      <MaxIcon />
      <VkIcon />
    </div>
  );
};
