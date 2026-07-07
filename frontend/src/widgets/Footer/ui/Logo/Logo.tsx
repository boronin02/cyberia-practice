import { LogoIcon } from "@/shared/assets/icons";
import styles from "./Logo.module.scss";

export const Logo = () => {
  return (
    <div className={styles.logo}>
      <LogoIcon width={540} height={100} />
    </div>
  );
};
